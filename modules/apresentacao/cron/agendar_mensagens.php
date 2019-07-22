<?php

//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
//ini_set('display_errors', 1);

ob_start();
chdir(dirname(dirname(dirname(__DIR__))));
require_once 'core.php';
ob_end_clean();
ob_start();
$ambiente = 'Prod'; // Prod
$emailDeTeste = 'fleck@pm.pr.gov.br';

$objetoPdo = new PDO($pdo['dsn']['sjd'], $pdo['user'], $pdo['password']);

//$sql = "SELECT distinct
//        a.*,
//        ifnull(pm.nome, res.NOME) as nome,
//        ifnull(pm.sexo, res.sexo) as sexo,
//        ifnull(pm.email_meta4, e.email) as email,
//        ifnull(pm.cargo, res.cargo) as cargo,
//        ifnull(pm.quadro,'') as quadro,
//        ifnull(pm.subquadro,
//        FROM sjd.apresentacao a
//        LEFT JOIN rhparana.policial pm on a.pessoa_rg = pm.rg
//        LEFT JOIN rhparana.INATIVOS res on a.pessoa_rg = res.cbr_num_rg AND res.ID_TIPO_RH = '02'
//        LEFT JOIN sjd.policial_email e on a.pessoa_rg = e.rg
//        WHERE a.comparecimento_data = :comparecimento_data;";

$sql = sprintf("
    SELECT * FROM sjd.apresentacao a WHERE
    a.id_apresentacaosituacao = :id_apresentacaosituacao AND
    (
        a.comparecimento_data = :comparecimento_data_dois_dias
        OR
        a.comparecimento_data = :comparecimento_data_sete_dias
        OR
        a.comparecimento_data = :comparecimento_data_trinta_dias
    )
    ;
", "");

$stmt = $objetoPdo->prepare($sql);

$objetoDataHoje = new DateTime();
$objetoDataDoisDias = new DateTime();
$objetoDataSeteDias = new DateTime();
$objetoDataTrintaDias = new DateTime();

$objetoDataDoisDias->add(new DateInterval('P2D'));
$objetoDataSeteDias->add(new DateInterval('P7D'));
$objetoDataTrintaDias->add(new DateInterval('P30D'));

$stmt->bindValue(':id_apresentacaosituacao', apresentacaosituacao::SITUACAO_PREVISTA);
$stmt->bindValue(':comparecimento_data_dois_dias', $objetoDataDoisDias->format("Y-m-d"));
$stmt->bindValue(':comparecimento_data_sete_dias', $objetoDataSeteDias->format("Y-m-d"));
$stmt->bindValue(':comparecimento_data_trinta_dias', $objetoDataTrintaDias->format("Y-m-d"));

$stmt->execute();

echo '-----------------------------------' . PHP_EOL;
echo 'DATA: ' . date('d/m/Y H:i:s') . PHP_EOL;
echo '-----------------------------------' . PHP_EOL;

echo sprintf("Foram encontradas %d apresentações" . PHP_EOL, $stmt->rowCount());

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $apresentacao = new apresentacao();
    $apresentacao->setValues(array('id'=>$row['id_apresentacao']));

    echo sprintf("Nº %d/%d\t", $apresentacao->sjd_ref, $apresentacao->sjd_ref_ano);

    $policial = $apresentacao->policial;

    echo sprintf("RG %s\tNOME %s\t", $row['pessoa_rg'], $row['pessoa_nome']);

    $policial_email = new policial_email();
    $policial_email->setValues('', sprintf("WHERE rg = '%s'", $row['pessoa_rg']));

    if ($ambiente == 'Prod') {
        $email = $policial->email;
        $email = empty($email) ? $policial_email->email : $email;
    } else {
        $email = $emailDeTeste;
    }

    if (empty($email)) {
        echo sprintf("Sem email cadastrado" .PHP_EOL);
        continue;
    }
    echo sprintf("%s".PHP_EOL, $email);
    $mensagem = $apresentacao->criarMensagem();

    colocarNaFilaParaEnvio($apresentacao, $policial->nome, $email, 'Lembrete de apresentação', $mensagem, $objetoPdo);

}

$saida = ob_get_clean();

file_put_contents(dirname(dirname(dirname(__DIR__))) . '/log/agendamento-apresentacao/agenda-apresentacao-' . date("Y-m-d") . '.log', $saida, FILE_APPEND);

function colocarNaFilaParaEnvio(apresentacao $apresentacao, $nome, $email, $assunto, $mensagem, $objetoPdo)
{
    $sql = "
        INSERT INTO sjd.email (
                contexto_email,
                id_contexto_email,
                remetente_nome,
                remetente_email,
                destinatario_nome,
                destinatario_email,
                assunto,
                mensagem_txt,
                formato,
                usuario_rg,
                dh_agendamento,
                prioridade
        ) VALUES (
                'apresentacao',
                :id_apresentacao,
                :remetente_nome,
                :remetente_email,
                :destinatario_nome,
                :destinatario_email,
                :assunto,
                :mensagem,
                'text/plain',
                '0',
                :dh_agendamento,
                :prioridade
        );
    ";

    $stmt = $objetoPdo->prepare($sql);

    $stmt->bindValue(':id_apresentacao', $apresentacao->id_apresentacao);
    $stmt->bindValue(':remetente_nome', 'SisCOGER');
    $stmt->bindValue(':remetente_email', 'no-reply-pmpr@pm.pr.gov.br');
    $stmt->bindValue(':destinatario_nome', $nome);
    $stmt->bindValue(':destinatario_email', $email);
    $stmt->bindValue(':assunto', $assunto);
    $stmt->bindValue(':mensagem', $mensagem);
    $stmt->bindValue(':dh_agendamento', date("Y-m-d 20:00:00"));
    $stmt->bindValue(':prioridade', '4');

    $stmt->execute();
}
