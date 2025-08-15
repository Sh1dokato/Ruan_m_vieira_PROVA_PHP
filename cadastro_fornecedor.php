<<<<<<< HEAD
<?php
session_start();
require_once 'conexao.php'; // Arquivo de conexão com o banco de dados

// Verifica se o usuário tem permissão de acesso (perfil 1)
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
    echo "Acesso negado!";
    exit();
}

// --- INÍCIO DA CORREÇÃO ---
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se o ID do usuário está na sessão.
    // Lembre-se de definir $_SESSION['usuario_id'] no seu script de login.
    if (!isset($_SESSION['usuario_id'])) {
        echo "<script>alert('Erro: Usuário não identificado. Faça o login novamente.');</script>";
    } else {
        // Coleta os dados do formulário
        $nome_fornecedor = $_POST['nome_fornecedor'];
        $contato = $_POST['contato'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $id_funcionario_registro = $_SESSION['usuario_id'];

        // Prepara a instrução SQL para inserir um novo fornecedor
        $sql = "INSERT INTO fornecedor (nome_fornecedor, contato, email, endereco, telefone, id_funcionario_registro) 
                VALUES (:nome_fornecedor, :contato, :email, :endereco, :telefone, :id_funcionario_registro)";
        $stmt = $pdo->prepare($sql);

        // Associa os parâmetros com os valores
        $stmt->bindParam(':nome_fornecedor', $nome_fornecedor);
        $stmt->bindParam(':contato', $contato);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':id_funcionario_registro', $id_funcionario_registro);

        // Executa a instrução e exibe uma mensagem de sucesso ou erro
        if ($stmt->execute()) {
            echo "<script>alert('Fornecedor cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar fornecedor!');</script>";
        }
    }
}
// --- FIM DA CORREÇÃO ---
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Cadastrar Fornecedor</h2>
    <form method="POST">
        <label for="nome_fornecedor">Nome do Fornecedor:</label>
        <input type="text" name="nome_fornecedor" id="nome_fornecedor" required>

        <label for="contato">Contato:</label>
        <input type="text" name="contato" id="contato">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco">

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone">

        <button type="submit">Salvar</button>
        <button type="reset">Cancelar</button>
    </form>
    <a href="principal.php">Voltar</a>

    <address><center>Ruan de Mello Vieira</center></address>
</body>
=======
<?php
session_start();
require_once 'conexao.php';

//Verifica se o usuario tem permissao
//Supondo que o perfil 1 seja o administrador

if($_SESSION['perfil'] != 1) {
    echo "Acesso negado!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash ($_POST['senha'],PASSWORD_DEFAULT);
    $id_perfil = $_POST['id_perfil'];

    $sql = "INSERT INTO usuario (nome, email, senha, id_perfil) VALUES (:nome, :email, :senha, :id_perfil)";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id_perfil', $id_perfil);

    if($stmt -> execute()) {
        echo "<script>alert('Usuario cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuario!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel principal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Cadastrar Usuario</h2>
    <form action="cadastro_usuario.php" method="POST">  
    <label for ="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <button type="submit">Salvar</button>
    <button type="reset">Cancelar</button>
    </form>
    <a href="principal.php">Voltar</a>

    <adress><center>Ruan de Mello Vieira</center></adress>
</body>
>>>>>>> da504c4d8b3f0c88d775decbc648048024dbd919
</html>