<?php

namespace App\Services;

use App\Models\Portfolio;

class PortfolioService
{
    public function getUserPortfolio($userId)
    {
        return Portfolio::where('user_id', $userId)->firstOrFail();
    }

    public function updatePortfolio($userId, array $data)
    {
        $portfolio = Portfolio::where('user_id', $userId)->firstOrFail();
        $portfolio->update($data);
        return $portfolio;
    }
}