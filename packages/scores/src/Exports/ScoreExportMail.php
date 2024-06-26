<?php

namespace Leo\Scores\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ScoreExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $totalUsers = DB::table('users')->count();
        $iphoneUsersCount = ceil($totalUsers * 0.10);
        $voucherUsersCount = ceil($totalUsers * 0.30);

        $users = DB::table('scores')
            ->join('users', 'scores.idUser', '=', 'users.id')
            ->where('scores.score','>=',5)
            ->select('users.name', 'users.id')
            ->addSelect(DB::raw('GROUP_CONCAT(scores.score ORDER BY scores.id) AS scores'))
            ->groupBy('users.id', 'users.name')
            ->get();
        $iphoneUsers = DB::table('scores')
            ->join('users', 'scores.idUser', '=', 'users.id')
            ->where('scores.score','>=',5)
            ->select('users.id')
            ->groupBy('users.id')
            ->inRandomOrder()
            ->limit($iphoneUsersCount)
            ->pluck('id');

        $voucherUsers = DB::table('scores')
            ->join('users', 'scores.idUser', '=', 'users.id')
            ->where('scores.score','>=',5)
            ->select('users.id')
            ->whereNotIn('users.id', $iphoneUsers->toArray())
            ->groupBy('users.id')
            ->inRandomOrder()
            ->limit($voucherUsersCount)
            ->pluck('id');

        // Format the user data for the export
        $formattedUsers = $users->map(function ($user) use ($iphoneUsers, $voucherUsers) {
            $scores = explode(',', $user->scores);
            $numEmptyCells = 10 - count($scores);
            $emptyCells = array_fill(0, $numEmptyCells, '');
            $reward = '';
            if ($iphoneUsers->contains($user->id)) {
                $reward = 'iPhone';
            } elseif ($voucherUsers->contains($user->id)) {
                $reward = 'Voucher';
            }
            return array_merge([$user->name], $scores, $emptyCells, [$reward]);
        });

        return $formattedUsers;
    }

    public function headings(): array
    {
        $headings = ['Name'];
        for ($i = 1; $i <= 10; $i++) {
            $headings[] = "Game $i";
        }
        $headings[] = 'Reward';

        return $headings;
    }
}
