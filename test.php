   <?php
   require 'vendor/autoload.php';

   use Slim\Factory\AppFactory;

   // Configuração do banco de dados (substitua com suas credenciais)
   $dbHost = 'localhost';
   $dbName = 'minha_saude'; // Nome do seu banco de dados
   $dbUser   = 'root'; // Seu usuário do MySQL
   $dbPass = ''; // Sua senha do MySQL

   try {
       $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser  , $dbPass);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       die("Erro de conexão: " . $e->getMessage());
   }

   $app = AppFactory::create();
   $app->addBodyParsingMiddleware();

   $app->post('/usuarios', function ($request, $response) use ($pdo) {
       $dados = $request->getParsedBody();

       if (empty($dados['cpf']) || empty($dados['nome_completo']) || empty($dados['data_nascimento']) || empty($dados['telefone']) || empty($dados['email']) || empty($dados['metodo_autenticacao'])) {
           return $response->withStatus(400)
               ->withHeader('Content-Type', 'application/json')
               ->write(json_encode(['erro' => 'Todos os campos são obrigatórios']));
       }

       $id = uniqid();

       $stmt = $pdo->prepare("INSERT INTO tb_usuario (id, cpf, nome_completo, data_nascimento, telefone, email, metodo_autenticacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
       $stmt->execute([$id, $dados['cpf'], $dados['nome_completo'], $dados['data_nascimento'], $dados['telefone'], $dados['email'], $dados['metodo_autenticacao']]);

       $usuarioCadastrado = [
           'id' => $id,
           'cpf' => $dados['cpf'],
           'nome_completo' => $dados['nome_completo'],
           'data_nascimento' => $dados['data_nascimento'],
           'telefone' => $dados['telefone'],
           'email' => $dados['email'],
           'metodo_autenticacao' => $dados['metodo_autenticacao'],
           'status_conta' => 'ativa',
           'created_at' => date('Y-m-d H:i:s')
       ];

       return $response->withStatus(201)
           ->withHeader('Content-Type', 'application/json')
           ->write(json_encode($usuarioCadastrado));
   });

   $app->get('/usuarios', function ($request, $response) use ($pdo) {
       $stmt = $pdo->query("SELECT id, cpf, nome_completo, data_nascimento, telefone, email, metodo_autenticacao, status_conta, created_at FROM tb_usuario WHERE deleted_at IS NULL");
       $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $response->withHeader('Content-Type', 'application/json')
           ->write(json_encode($usuarios));
   });

   $app->get('/test', function ($request, $response) {
       $response->getBody()->write(json_encode([
           'status' => 'API funcionando',
           'endpoints' => [
               'POST /usuarios' => 'Cadastrar novo usuário',
               'GET /usuarios' => 'Listar todos os usuários'
           ]
       ]));
       return $response->withHeader('Content-Type', 'application/json');
   });

   echo "Servidor iniciado. Endpoints disponíveis:\n";
   echo "- POST http://localhost:8000/usuarios\n";
   echo "- GET http://localhost:8000/usuarios\n";
   echo "- GET http://localhost:8000/test\n\n";

   $app->run();
   