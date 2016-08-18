<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Form_Validation
 *
 * @author Your Name <your.name at your.org>
 */
class MY_Form_Validation extends CI_Form_validation
{

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    /**
     * Greather than
     *
     * @access    public
     *
     * @param    string
     *
     * @return    bool
     */
    public function greater_than($str, $min)
    {
        $valor = numeroParaGravacao($str);
        if (!is_numeric($valor)) {
            return false;
        }

        return $valor > $min;
    }

    /**
     * Less equals than
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function less_equals_than($str, $max)
    {
        $valor = numeroParaGravacao($str);

        if (!is_numeric($valor)) {
            return FALSE;
        }
        return $valor <= $max;
    }

    /**
     * Verifica se a data é válida - valida dia, mês e ano conforme calendário gregoriano
     *
     * @param $str data no formato de exibição dd/mm/yyyy
     *
     * @return bool
     */
    public function valid_date($str)
    {
        return dataValida($str);
    }

    /**
     * Compara duas datas, verificando se uma é maior que a outra
     * Usa a classe DateTime para isso
     * php >= 5.2.2 é possível comparar duas instâncias de datetime com operadores de comparação
     *
     * @param $str       data base no formato de exibição dd/mm/yyyy
     * @param $compareTo data no formato de exibição dd/mm/yyyy
     */
    public function date_greater_than_today($str)
    {
        $valid = true;
        $valueToCompare = date('d/m/Y');

        if (dataValida($str) && dataValida($valueToCompare)) {
            $data1 = new DateTime(dataParaGravacao($str));
            $data2 = new DateTime(dataParaGravacao($valueToCompare));

            $valid = ($data1 > $data2);
        }

        return $valid;
    }

    /**
     * Compara duas datas, verificando se uma é maior que a outra
     * Usa a classe DateTime para isso
     * php >= 5.2.2 é possível comparar duas instâncias de datetime com operadores de comparação
     *
     * @param $str       data base no formato de exibição dd/mm/yyyy
     * @param $compareTo data no formato de exibição dd/mm/yyyy
     */
    public function date_greater_than($str, $compareTo)
    {
        $valid = true;

        if (isset($_POST[$compareTo])) {
            $valueToCompare = $_POST[$compareTo];

            if (dataValida($str) && dataValida($valueToCompare)) {
                $data1 = new DateTime(dataParaGravacao($str));
                $data2 = new DateTime(dataParaGravacao($valueToCompare));

                $valid = ($data1 > $data2);
            }
        }

        return $valid;
    }

    /**
     * Compara duas datas, verificando se uma é maior ou igual que a outra
     * Usa a classe DateTime para isso
     * php >= 5.2.2 é possível comparar duas instâncias de datetime com operadores de comparação
     *
     * @param $str       data base no formato de exibição dd/mm/yyyy
     * @param $compareTo data no formato de exibição dd/mm/yyyy
     */
    public function date_greater_equals_than($str, $compareTo)
    {
        $valid = true;

        if (isset($_POST[$compareTo])) {
            $valueToCompare = $_POST[$compareTo];

            if (dataValida($str) && dataValida($valueToCompare)) {
                $data1 = new DateTime(dataParaGravacao($str));
                $data2 = new DateTime(dataParaGravacao($valueToCompare));

                $valid = ($data1 >= $data2);
            }
        }

        return $valid;
    }

    /**
     * Valida se uma hora é válida
     *
     * @param $str       hora no formato hh:mm
     *
     * @return boolean
     */
    public function valid_time($str)
    {
        return (criarObjetoHora($str) !== null);
    }

    /**
     * Valida se uma hora é maior que a outra (considerando o mesmo dia)
     *
     * @param $str       hora no formato hh:mm
     * @param $compareTo nome do campo com a hora para comparar
     *
     * @return bool
     */
    public function time_greater_than($str, $compareTo)
    {
        $valid = true;

        if (isset($_POST[$compareTo])) {
            $valueToCompare = $_POST[$compareTo];
            $hora1 = criarObjetoHora($str);
            $hora2 = criarObjetoHora($valueToCompare);

            if ($hora1 !== null && $hora2 !== null) {
                $valid = ($hora1 > $hora2);
            }
        }

        return $valid;
    }

    /**
     *
     * valid_cpf
     *
     * Verifica CPF é válido
     * @access    public
     * @param    string
     * @return    bool
     */
    function valid_cpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf)) {
            return false;
        }

        // 9 primeiros digitos do cpf
        $digit = substr($cpf, 0, 9);

        // calculo dos 2 digitos verificadores
        for ($j = 10; $j <= 11; $j++) {
            $sum = 0;
            for ($i = 0; $i < $j - 1; $i++) {
                $sum += ($j - $i) * ((int)$digit[$i]);
            }

            $summod11 = $sum % 11;
            $digit[$j - 1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }

        return $digit[9] == ((int)$cpf[9]) && $digit[10] == ((int)$cpf[10]);
    }

    /**
     * Verifica se o CNPJ é valido
     * @param     string
     * @return     bool
     */
    function valid_cnpj($str)
    {
        if (strlen($str) <> 18)
            return FALSE;
        $soma1 = ($str[0] * 5) +
            ($str[1] * 4) +
            ($str[3] * 3) +
            ($str[4] * 2) +
            ($str[5] * 9) +
            ($str[7] * 8) +
            ($str[8] * 7) +
            ($str[9] * 6) +
            ($str[11] * 5) +
            ($str[12] * 4) +
            ($str[13] * 3) +
            ($str[14] * 2);
        $resto = $soma1 % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;
        $soma2 = ($str[0] * 6) +
            ($str[1] * 5) +
            ($str[3] * 4) +
            ($str[4] * 3) +
            ($str[5] * 2) +
            ($str[7] * 9) +
            ($str[8] * 8) +
            ($str[9] * 7) +
            ($str[11] * 6) +
            ($str[12] * 5) +
            ($str[13] * 4) +
            ($str[14] * 3) +
            ($str[16] * 2);
        $resto = $soma2 % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;
        return (($str[16] == $digito1) && ($str[17] == $digito2));
    }

    public function is_unique($str, $field)
    {
        $field_ar = explode('.', $field);
        $query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
        if ($query->num_rows() === 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function edit_unique($value, $params)
    {
        list($table, $field, $id) = explode(".", $params, 3);

        $query = $this->CI->db->select($field)->from($table)
            ->where($field, $value)->where('id !=', $id)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

}
