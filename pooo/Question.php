<?php

class Question {
    private string $intitule;
    private bool $estReponse;

    public function __construct(string $intitule, bool $estReponse) {
        $this->intitule = $intitule;
        $this->estReponse = $estReponse;
    }

    public function getIntitule(): string {
        return $this->intitule;
    }

    public function getestReponse(): bool {
        return $this->estReponse;
    }

    public function setestReponse(bool $estReponse): void {
        $this->estReponse = $estReponse;
    }
}
?>