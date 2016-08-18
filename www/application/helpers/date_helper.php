<?php
define('DATA_PERIODO_SEMANAL', 1);
define('DATA_PERIODO_MENSAL', 2);
define('DATA_PERIODO_BIMESTRAL', 3);
define('DATA_PERIODO_TRIMESTRAL', 4);
define('DATA_PERIODO_SEMESTRAL', 5);
define('DATA_PERIODO_ANUAL', 6);

function DATAATUAL($formato = "d/m/Y")
{
    return date($formato);
}

function dataParaExibicao($data, $formato = "d/m/Y")
{

    $retorno = null;

    if ($data !== null) {
        $retorno = date($formato, strtotime($data));
    }

    return $retorno;
}

function dataParaGravacao($data, $formato = "Y-m-d")
{

    $retorno = null;

    if ($data !== null) {
        $retorno = date($formato, strtotime(str_replace('/', '-', $data)));
    }

    return $retorno;
}

function dateIsValid($date)
{
    $data = explode('/', $date);

    return (checkdate($data[1], $data[0], $data[2]) === 1 ? true : false);
}

function dataPrimeiroDiaDoMes()
{
    return '01/' . date('m/Y');
}

function dataUltimoDiaDoMes()
{
    return date('t/m/Y');
}

function dataPrimeiroDia($mes, $ano)
{
    return '01/' . $mes . '/' . $ano;
}

function dataUltimoDia($mes, $ano)
{
    return date('t/m/Y', strtotime(dataParaGravacao(dataPrimeiroDia($mes, $ano))));
}

function dataHoraParaGravacao($data, $formato = 'Y-m-d H:i:s')
{
    return date($data, $formato);
}

function dataAddDias($diasAdd, $data)
{
    $ano = date("Y", strtotime($data));
    $mes = date("m", strtotime($data));
    $dia = date("d", strtotime($data));

    return date('Y-m-d', mktime(0, 0, 0, $mes, $dia + $diasAdd, $ano));
}

/**
 * Cria um array a partir de uma data
 *
 * @param        $str       string de data a ser transformada em array
 * @param string $separador separador de data - default é "/"
 *
 * @return array|null
 */
function dataParaArray($str, $separador = "/")
{
    $dateExplode = explode($separador, $str);
    $array = null;

    if (count($dateExplode) === 3) {
        $array = $dateExplode;
    }

    return $array;
}

/**
 * AVISO: essa função é usada também pelo MY_FORM_VALIDATION e tem que retornar true/false
 * Valida se uma data está no formato correto (usando checkdate do php)
 * Considera o formato dia/mes/ano ou ano-mes-dia
 * Se a data não estiver em nenhum dos formatos acima, returna true, caso contrário valida
 *
 * @param        $str       string de data a ser transformada em array
 * @param string $separador separador de data - default é "/"
 *
 * @return true/false
 */
function dataValida($str)
{
    $arrayStr = dataParaArray($str, "/");
    $formatoInverso = false;

    if ($arrayStr === null) {
        $arrayStr = dataParaArray($str, "-");
        $formatoInverso = true;
    }

    $dataValida = true;

    if ($arrayStr !== null) {
        $dataValida = ($formatoInverso ? checkdate($arrayStr[1], $arrayStr[2], $arrayStr[0]) : checkdate($arrayStr[1], $arrayStr[0], $arrayStr[2]));
    }

    return $dataValida;
}

function dataAddMes($mesesAdd, $data)
{
    $ano = date("Y", strtotime($data));
    $mes = date("m", strtotime($data));
    $dia = date("d", strtotime($data));

    return date('Y-m-d', mktime(0, 0, 0, $mes + $mesesAdd, $dia, $ano));
}

function dataAddAno($anosAdd, $data)
{
    $ano = date("Y", strtotime($data));
    $mes = date("m", strtotime($data));
    $dia = date("d", strtotime($data));

    return date('Y-m-d', mktime(0, 0, 0, $mes, $dia, $ano + $anosAdd));
}

function dataIncrementa($periodo, $data = '')
{
    if ($data == '') {
        $data = dataParaGravacao(dataAtual());
    }

    switch ($periodo) {
        case DATA_PERIODO_SEMANAL:
            $data = dataAddDias(7, $data);
            break;
        case DATA_PERIODO_MENSAL:
            $data = dataAddMes(1, $data);
            break;
        case DATA_PERIODO_BIMESTRAL:
            $data = dataAddMes(2, $data);
            break;
        case DATA_PERIODO_TRIMESTRAL:
            $data = dataAddMes(3, $data);
            break;
        case DATA_PERIODO_SEMESTRAL:
            $data = dataAddMeses(6, $data);
            break;
        case DATA_PERIODO_ANUAL:
            $data = dataAddAno(1, $data);
            break;
    }
    return $data;
}

/**
 * Retorna uma data no formato MES (sendo mês o nome do mês completo e em PT-BR)
 * @param type $data data para formatar. O formato espero aqui é Y-m-d
 * @return type string com a data formatada
 */
function dataMesExtenso($data)
{
    setlocale(LC_TIME, "");
    setlocale(LC_TIME, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

    return strftime("%B", strtotime($data));
}

/**
 * Retorna uma data no formato DIA/MES (sendo mês o nome do mês completo e em PT-BR)
 * Quando $trataAnoDiff = TRUE, retorna também o ano, somente se for diferente do atual
 * @param type $data data para formatar. O formato espero aqui é Y-m-d
 * @return type string com a data formatada
 */
function dataDiaNomeCompletoMes($data, $trataAnoDiff = FALSE)
{
    setlocale(LC_TIME, "");
    setlocale(LC_TIME, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    if ($trataAnoDiff) {
        if (dataParaGravacao($data, 'Y') != dataAtual('Y')) {
            return strftime("%d/%B/%Y", strtotime($data));
        } else {
            return strftime("%d/%B", strtotime($data));
        }
    } else {
        return strftime("%d/%B", strtotime($data));
    }
}

/**
 * Subtrai o intervalo da data informada
 * @param $data = data base no formato Y-m-d
 * @param $interval = DateTimeInterval string (ver manual do php)
 */
function dataSubtrair($data, $interval)
{
    $dateTime = new DateTime($data);
    $dateTime->sub(new DateInterval($interval));

    return $dateTime->format('Y-m-d');
}

/**
 * Adiciona o intervalo na data informada
 * @param $data = data base no formato Y-m-d
 * @param $interval = DateTimeInterval string (ver manual do php)
 */
function dataAdicionar($data, $interval)
{
    $dateTime = new DateTime($data);
    $dateTime->add(new DateInterval($interval));

    return $dateTime->format('Y-m-d');
}

function dataDiff($data1, $data2)
{
    $datetime1 = date_create($data1);
    $datetime2 = date_create($data2);
    $interval = date_diff($datetime1, $datetime2);

    return $interval->days;
}

function dataCalcularProximoVencimento($diaVencimento, $idPeriodicidade)
{

    $ci = &get_instance();

    $ci->load->model('periodicidade_model');

    $diaVencimento = dataParaGravacao($diaVencimento);

    $diasPeriodicidade = $ci->periodicidade_model->get_by_id($idPeriodicidade);


    if ($diasPeriodicidade->numeroDias < 30) {
        $proximoVencimento = dataAddDias($diasPeriodicidade->numeroDias, $diaVencimento);
    } else {
        $mesesPeriodicidade = $diasPeriodicidade->numeroDias / 30;
        $proximoVencimento = new DateTime($diaVencimento);
        $proximoVencimento->setDate($proximoVencimento->format("Y"), $proximoVencimento->format("m"), dataParaExibicao($diaVencimento, 'd'));

        if ($proximoVencimento) {
            $proximoVencimento = dataAddMes($mesesPeriodicidade, $proximoVencimento->format("Y-m-d"));
        }
    }

    return $proximoVencimento;
}

function dataDiaSemanaExtenso($data, $formato = "%A")
{
    setlocale(LC_TIME, NULL);
    setlocale(LC_TIME, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

    return strftime($formato, strtotime($data));
}

function dataDiaSemanaAbreviado($data)
{
    return dataDiaSemanaExtenso($data, '%a');
}
