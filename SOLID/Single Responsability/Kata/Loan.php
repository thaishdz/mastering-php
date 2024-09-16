<?php

require_once('./User.php');
require_once('./Book.php');

class Loan
{
    public function __construct(
        private int  $remainingLoanDays = 7,
        private bool $penalty = false
    ) 
    {}
    
    public function remainingLoanDays(): int
    {
        return $this->remainingLoanDays;
    }

    public function penalty(): bool
    {
        return $this->penalty;
    }
}
