<?php 

enum Privilegios: int {
    case User = 1;
    case Recepcionist = 2; 
    case Doctor = 4;
    case Admin = 8;
    public function get(): int{
        return match ($this) {
            static::User => 1,
            static::Recepcionist => 2,
            static::Doctor => 4,
            static::Admin => 8,
        };
    }

    public static function check($rol) {
        return ($rol & $_SESSION["privilegios"]) == $rol ? true : false;
    }
}