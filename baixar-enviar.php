<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "🔽 Baixando arquivo arq.zip do FTP da LocalWeb...\n";

$localweb_host = "191.252.83.183";         // 1º define o host
$localweb_user = getenv('LWEB_USER');// 2º pega user do secrets
$localweb_pass = getenv('LWEB_PASS');// 3º pega senha do secrets
$remote_file = "arq.zip";                  // 4º nome do arquivo remoto
$local_file  = "arq.zip";                  // 5º nome do arquivo local

// Monta o comando curl com as variáveis na ordem correta
$download_cmd = "curl -u '$localweb_user:$localweb_pass' ftp://$localweb_host/$remote_file -o $local_file";

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
$local_file = "arq.zip"; // Certifique-se de que este caminho está correto

$dest_paths = [
    "crgr.com.br/arq.zip",
    "loja1.testeagencia.dev.br/wp-content/uploads/arq.zip"
];

foreach ($dest_paths as $dest_path) {
    $upload_cmd = "curl -T $local_file -u '$hg_user:$hg_pass' ftp://$hg_host/$dest_path";
    exec($upload_cmd, $output_upload, $ret_upload);

    if ($ret_upload !== 0) {
        echo "❌ Erro ao enviar para $dest_path\n";
        print_r($output_upload);
        exit;
    }

    echo "✅ Upload finalizado para /$dest_path\n";
}
