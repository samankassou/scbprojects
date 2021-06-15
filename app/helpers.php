<?php


if (!function_exists('castNumberId')) {
    function castNumberId($number, $ent=3, $dec=0)
    {
        if ($dec==0) {
            $strNbr = "";
            $strNbr .= $number;
            if (strpos($strNbr, '.')!=false) {
                $tmp=explode('.', $strNbr);
                $strNbr="".$tmp[0];
            }

            $strSize = strlen($strNbr);
            $strFinal = array();
            for ($k = 1; $k <= $ent; $k++)
                array_push($strFinal, 0);
            for ($i = 0; $i < $strSize; $i++) {
                $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
            }
            $castedNbr = "";
            for ($j = 0; $j < $ent; $j++)
                $castedNbr .= $strFinal[$j];
            return $castedNbr;
        } else if ($dec!=0 and is_integer($dec))
        {
            $nt="";
            $nt.=$number;
            $fnt="";
            if (strpos($nt, '.')==false) {
                $strNbr = $nt;
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                $fnt = $int . '.';
                for ($i = 1; $i <= $dec; $i++) $fnt .= '0';
                return $fnt;
            }
            else
            {
                $tmp=explode('.', $nt);
                //Partie enti�re
                $strNbr = "";
                $strNbr .= $tmp[0];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                //Partie d�cimale
                $strNbr = "";
                $strNbr .= $tmp[1];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $dec; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$i] = $strNbr[$i];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $flt=$castedNbr;

                return $int.'.'.$flt;
            }
        } else return $number;
    }
}