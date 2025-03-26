<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "🔽 Baixando arquivo arq.zip do FTP da LocalWeb...\n";

$ftp_user = getenv('LWEB_USER');
$ftp_pass = getenv('LWEB_PASS');
$ftp_host = "191.252.83.183";
$remote_file = "arq.zip";
$local_file = "arq.zip";

$download_cmd = "curl -u '$ftp_user:$ftp_pass' ftp://$ftp_host/$remote_file -o $local_file";
exec($download_cmd, $output, $ret);

if ($ret !== 0 || !file_exists($local_file) || filesize($local_file) === 0) {
    echo "❌ Erro ao baixar o arquivo da LocalWeb.\n";
    print_r($output);
    exit;
}

echo "✅ Download concluído com sucesso!\n";

echo "📤 Enviando arq.zip para FTP da HostGator...\n";

$hg_user = getenv('HG_USER');
$hg_pass = getenv('HG_PASS');
$hg_host = "ftp.pratasilver.com";
$dest_path = "testeagencia.dev.br/arq.zip";

$upload_cmd = "curl -T $local_file -u '$hg_user:$hg_pass' ftp://$hg_host/$dest_path";
exec($upload_cmd, $output_upload, $ret_upload);

if ($ret_upload !== 0) {
    echo "❌ Erro ao enviar o arquivo para a HostGator.\n";
    print_r($output_upload);
    exit;
}

echo "✅ Upload finalizado para /testeagencia.dev.br/arq.zip\n";
