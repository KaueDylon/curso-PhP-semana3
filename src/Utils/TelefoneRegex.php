<?php
declare(strict_types=1);

namespace App\Utils;

class TelefoneRegex
{
    public static function formatarTelefone($telefone): string
    {

        if(strlen($telefone) == 10){

            return preg_replace(
                '/(\d{2})(\d{4})(\d{4})/',
                '($1) $2-$3',
                $telefone
            );
        }elseif (strlen($telefone) == 11){
            return preg_replace(
                '/(\d{2})(\d{5})(\d{4})/',
                '($1) $2-$3',
                $telefone
            );
        }else{
            return preg_replace(
                '/(\d{4})(\d{4})/',
                '$1-$2',
                $telefone
            );
        }

    }
}
