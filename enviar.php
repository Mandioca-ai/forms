<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $menor = isset($_POST['menor']) ? 'Sim' : 'Não';
    $entre = isset($_POST['entre']) ? 'Sim' : 'Não';
    $maior = isset($_POST['maior']) ? 'Sim' : 'Não';
    $camisa = isset($_POST['camisa']) ? 'Sim' : 'Não';
    $transporte = isset($_POST['transporte']) ? 'Sim' : 'Não';
    $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';

    // Para o arquivo de comprovante
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == 0) {
        $pdfFile = $_FILES['pdfFile'];
        $pdfFileName = $pdfFile['name'];
        $pdfFileTemp = $pdfFile['tmp_name'];

        // Define o diretório onde o arquivo será salvo
        $diretorio = 'uploads/'; // Certifique-se de que este diretório exista e tenha permissões de escrita
        $caminhoCompleto = $diretorio . basename($pdfFileName);

        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($pdfFileTemp, $caminhoCompleto)) {
            // Abre o arquivo para adicionar os dados
            $arquivo = fopen('inscricoes.csv', 'a'); // 'a' para adicionar ao final do arquivo

            // Escreve os dados no arquivo CSV
            $linha = "$nome,$cpf,$email,$menor,$entre,$maior,$camisa,$transporte,$data_nascimento,$pdfFileName\n";
            fwrite($arquivo, $linha); // Escreve a linha no arquivo

            // Fecha o arquivo
            fclose($arquivo);

            echo "Dados inseridos com sucesso! O arquivo foi salvo.";
        } else {
            echo "Erro ao mover o arquivo para o diretório.";
        }
    } else {
        echo "Nenhum arquivo foi enviado ou ocorreu um erro.";
    }
} else {
    echo "O formulário não foi enviado.";
}
?>