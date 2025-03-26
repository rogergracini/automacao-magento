<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- FTP da LocalWeb (origem)
echo "🔽 Baixando arquivo arq.zip do FTP da LocalWeb...\n";

$localweb_host = "191.252.83.183";
$localweb_user = "palm20@galle";
$localweb_pass = "Jequitiba1539!";
$remote_file = "arq.zip";
$local_file = __DIR__ . "/arq.zip";

$download = "curl -u \"$localweb_user:$localweb_pass\" ftp://$localweb_host/$remote_file -o \"$local_file\"";
exec($download, $out1, $ret1);

if ($ret1 !== 0 || !file_exists($local_file) || filesize($local_file) === 0) {
    echo "❌ Erro ao baixar o arquivo da LocalWeb.\n";
    exit;
}
echo "✅ Download concluído com sucesso!\n";

// --- FTP da HostGator (destino)
echo "📤 Enviando arq.zip para FTP da HostGator...\n";

$hostgator_host = "ftp.pratasilver.com";
$hostgator_user = "pratas31";
$hostgator_pass = "#Ewdfh1k7@2025";
$hostgator_path = "testeagencia.dev.br/arq.zip";

$upload = "curl -T \"$local_file\" -u \"$hostgator_user:$hostgator_pass\" ftp://$hostgator_host/$hostgator_path";
exec($upload, $out2, $ret2);

if ($ret2 !== 0) {
    echo "❌ Erro ao enviar o arquivo para o FTP da HostGator.\n";
    exit;
}

echo "✅ Upload finalizado para /testeagencia.dev.br/arq.zip\n";
