<?php

namespace App\Services\Calculators;

class FinancialFormulaService
{
    public function amortizedPayment(float $principal, float $annualRate, int $months): float
    {
        if ($months <= 0) {
            return 0.0;
        }

        $monthlyRate = $annualRate / 1200;

        if ($monthlyRate == 0.0) {
            return $principal / $months;
        }

        return $principal * $monthlyRate * ((1 + $monthlyRate) ** $months) / (((1 + $monthlyRate) ** $months) - 1);
    }

    public function futureValueLumpSum(float $principal, float $annualRate, int $frequency, float $years): float
    {
        if ($frequency <= 0) {
            $frequency = 1;
        }

        return $principal * ((1 + ($annualRate / 100) / $frequency) ** ($frequency * $years));
    }

    public function futureValueSeries(float $monthlyContribution, float $annualRate, int $months): float
    {
        if ($months <= 0) {
            return 0.0;
        }

        $monthlyRate = $annualRate / 1200;

        if ($monthlyRate == 0.0) {
            return $monthlyContribution * $months;
        }

        return $monthlyContribution * ((((1 + $monthlyRate) ** $months) - 1) / $monthlyRate) * (1 + $monthlyRate);
    }

    public function debtPayoff(float $balance, float $annualRate, float $monthlyPayment): array
    {
        $monthlyRate = $annualRate / 1200;
        $interestCheck = $balance * $monthlyRate;

        if ($monthlyPayment <= $interestCheck && $monthlyRate > 0) {
            return [
                'months' => null,
                'interest' => null,
                'total_paid' => null,
                'warning' => 'The monthly payment is not high enough to reduce the balance under these assumptions.',
            ];
        }

        $remaining = $balance;
        $months = 0;
        $totalInterest = 0.0;
        $totalPaid = 0.0;

        while ($remaining > 0 && $months < 1200) {
            $interest = $remaining * $monthlyRate;
            $principalPaid = min($monthlyPayment - $interest, $remaining);
            $payment = $principalPaid + $interest;

            $remaining -= $principalPaid;
            $totalInterest += $interest;
            $totalPaid += $payment;
            $months++;

            if ($monthlyRate == 0.0) {
                $remaining = max(0, $remaining);
            }
        }

        return [
            'months' => $months,
            'interest' => $totalInterest,
            'total_paid' => $totalPaid,
            'warning' => null,
        ];
    }

    public function amortizationSchedule(float $principal, float $annualRate, int $months, float $monthlyPayment): array
    {
        $monthlyRate = $annualRate / 1200;
        $balance = $principal;
        $schedule = [];

        for ($month = 1; $month <= $months && $balance > 0.01; $month++) {
            $interest = $balance * $monthlyRate;
            $principalPaid = $monthlyPayment - $interest;

            if ($monthlyRate == 0.0) {
                $principalPaid = $monthlyPayment;
            }

            if ($principalPaid > $balance) {
                $principalPaid = $balance;
            }

            $payment = $principalPaid + $interest;
            $balance = max(0, $balance - $principalPaid);

            $schedule[] = [
                'month' => $month,
                'payment' => $payment,
                'principal' => $principalPaid,
                'interest' => $interest,
                'balance' => $balance,
            ];
        }

        return $schedule;
    }
}
