<?php
class Util
{
    public function getData()
    {
         $meses = array(
             1 => "Janeiro",
             2 => "Fevereiro",
             3 => "Março",
             4 => "Abril",
             5 => "Maio",
             6 => "Junho",
             7 => "Julho",
             8 => "Agosto",
             9 => "Setembro",
             10 => "Outubro",
             11 => "Novembro",
             12 => "Dezembro");

         $diasdasemana = array (
             1 => "Segunda-Feira",
             2 => "Terça-Feira",
             3 => "Quarta-Feira",
             4 => "Quinta-Feira",
             5 => "Sexta-Feira",
             6 => "Sábado",
             0 => "Domingo");

         $hoje = getdate();
         $dia = $hoje["mday"];
         $mes = $hoje["mon"];
         $nomemes = $meses[$mes];
         $ano = $hoje["year"];
         $diadasemana = $hoje["wday"];
         $nomediadasemana = $diasdasemana[$diadasemana];

         return "$nomediadasemana, $dia de $nomemes de $ano";
    }

    public function saudacoes()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $hr = date(" H ");
        if ($hr >= 12 && $hr < 18) {
            return "Boa tarde ";

        } else if ($hr >= 0 && $hr < 12) {
            return "Bom dia ";

        } else {
            return "Boa noite ";
        }
    }

    public function sequencia($href, $t, $metodo)
    {
        return '<ol class="breadcrumb">
                <li><a href="' . $href . '">' . $t . '</a></li>
                <li class="active">' . $metodo . '</li>  
               </ol>';
    }

    public function verificaAcesso($modulo,$sessao)
    {
        foreach($sessao as $$this->_table):
            if($modulo == $$this->_table) {
                return true;
            }
        endforeach;
        
        return false;
    }

    public function geraUrlLimpa($texto)
    {
        $url = $texto;
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;
    }

    public function mesPorExtenso($mes)
    {
        $mes = intval($mes);
        $extenso = '';

        switch($mes) {
            case 1: return "JAN";break;
            case 2: return "FEV";break;
            case 3: return "MAR";break;
            case 4: return "ABR";break;
            case 5: return "MAI";break;
            case 6: return "JUN";break;
            case 7: return "JUL";break;
            case 8: return "AGO";break;
            case 9: return "SET";break;
            case 10: return "OUT";break;
            case 11: return "NOV";break;
            case 12: return "DEZ";break;
        }
    }

    public function dataPorExtenso($data)
    {
        $data = explode("-",$data);
        $mes = '';

        switch (intval($data[1])) {
            case 1: $mes = "Janeiro";break;
            case 2: $mes = "Fevereiro";break;
            case 3: $mes = "Março";break;
            case 4: $mes = "Abril";break;
            case 5: $mes = "Maio";break;
            case 6: $mes = "Junho";break;
            case 7: $mes = "Julho";break;
            case 8: $mes = "Agosto";break;
            case 9: $mes = "Setembro";break;
            case 10: $mes = "Outubro";break;
            case 11: $mes = "Novembro";break;
            case 12: $mes = "Dezembro";break;
        }

        return $data[2]." de ".$mes." de ".$data[0];
    }

    public function getDiaNumerico()
    {
        $dd = date("w");
        
        switch($dd) {
            case"0": return 7; break;
            case"1": return 1; break;
            case"2": return 2; break;
            case"3": return 3; break;
            case"4": return 4; break;
            case"5": return 5; break;
            case"6": return 6; break;
        }
    }

    public function getCurrentDay()
    {
         $dd = date("w");

        switch($dd) {
            case"0": return "Domingo"; break;
            case"1": return "Segunda-feira"; break;
            case"2": return "Terça-feira"; break;
            case"3": return "Quarta-feira"; break;
            case"4": return "Quinta-feira"; break;
            case"5": return "Sexta-feira"; break;
            case"6": return "Sabado"; break;
        }
    }

    public function getMesName($data){
        $mes = 0;
        if (strstr($data, "-")){
            $data = explode("-",$data); //0 ano, 1 dia, 2 mes
            $mes = $data[2];    
        } elseif (strstr($data, "/")){
            $data = explode("/",$data); // 0dia, 1 mes, 3 ano
            $mes = $data[1];
        }

        switch(intval($mes)){
            case 1: return "Janeiro";break;
            case 2: return "Fevereiro";break;
            case 3: return "Março";break;
            case 4: return "Abril";break;
            case 5: return "Maio";break;
            case 6: return "Junho";break;
            case 7: return "Julho";break;
            case 8: return "Setembro";break;
            case 9: return "Agosto";break;
            case 10: return "Outubro";break;
            case 11: return "Novembro";break;
            case 12: return "Dezembro";break;
            default: return "";break;
        }
    }
}