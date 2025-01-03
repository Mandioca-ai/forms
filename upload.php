<?php
// Verifica se o arquivo foi enviado
if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == 0) {
    $pdfFile = $_FILES['pdfFile'];
    $pdfFileName = $pdfFile['name'];
    $pdfFileTemp = $pdfFile['tmp_name'];

    // Define o diretório onde o arquivo será salvo
    $diretorio = 'uploads/'; // Certifique-se de que este diretório exista e tenha permissões de escrita
    $caminhoCompleto = $diretorio . basename($pdfFileName);

    // Move o arquivo para o diretório desejado
    if (move_uploaded_file($pdfFileTemp, $caminhoCompleto)) {
        echo "Arquivo enviado com sucesso: " . htmlspecialchars($pdfFileName);
    } else {
        echo "Erro ao mover o arquivo para o diretório.";
    }
} else {
    echo "Nenhum arquivo foi enviado ou ocorreu um erro.";
}
?>