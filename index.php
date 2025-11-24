<?php
// SISTEMA DE ESTOQUE - NOITE-A-NOITE ATACADISTA
// =============================================

session_start();

// Dados fixos - sem banco de dados
$fornecedores = [
    ['id' => 1, 'nome' => 'Distribuidora Alimentícia Ltda', 'cnpj' => '12.345.678/0001-90', 'telefone' => '(11) 3333-4444', 'email' => 'vendas@distalimenticia.com.br', 'prazo_entrega' => 5],
    ['id' => 2, 'nome' => 'Bebidas do Brasil S.A.', 'cnpj' => '98.765.432/0001-10', 'telefone' => '(11) 5555-6666', 'email' => 'pedidos@bebidasbrasil.com', 'prazo_entrega' => 3],
    ['id' => 3, 'nome' => 'Limpeza Total Indústria', 'cnpj' => '11.222.333/0001-44', 'telefone' => '(11) 7777-8888', 'email' => 'compras@limpezatotal.com', 'prazo_entrega' => 7],
    ['id' => 4, 'nome' => 'Nestlé Brasil Ltda', 'cnpj' => '60.409.075/0001-52', 'telefone' => '(11) 5508-7070', 'email' => 'vendas@nestle.com.br', 'prazo_entrega' => 4],
    ['id' => 5, 'nome' => 'Coca-Cola Femsa', 'cnpj' => '43.903.555/0001-90', 'telefone' => '(11) 4890-4000', 'email' => 'pedidos@cocacola.com.br', 'prazo_entrega' => 2],
    ['id' => 6, 'nome' => 'Unilever Brasil Ltda', 'cnpj' => '61.068.264/0001-04', 'telefone' => '(11) 3767-7000', 'email' => 'vendas@unilever.com', 'prazo_entrega' => 6],
    ['id' => 7, 'nome' => 'P&G Brasil Ltda', 'cnpj' => '61.116.117/0001-20', 'telefone' => '(11) 5180-8000', 'email' => 'compras@pg.com', 'prazo_entrega' => 5],
    ['id' => 8, 'nome' => 'Ambev S.A.', 'cnpj' => '07.526.557/0001-00', 'telefone' => '(11) 2122-1000', 'email' => 'pedidos@ambev.com.br', 'prazo_entrega' => 3],
    ['id' => 9, 'nome' => 'Pepsico Brasil Ltda', 'cnpj' => '61.116.117/0001-30', 'telefone' => '(11) 5503-4000', 'email' => 'vendas@pepsico.com.br', 'prazo_entrega' => 4],
    ['id' => 10, 'nome' => 'Danone Brasil Ltda', 'cnpj' => '61.116.117/0001-40', 'telefone' => '(11) 5503-5000', 'email' => 'compras@danone.com', 'prazo_entrega' => 5]
];

$clientes = [
    ['id' => 1, 'nome' => 'Mercado Central', 'cnpj_cpf' => '123.456.789-09', 'telefone' => '(11) 1111-2222', 'limite_credito' => 50000.00],
    ['id' => 2, 'nome' => 'Supermercado Bom Preço', 'cnpj_cpf' => '987.654.321-00', 'telefone' => '(11) 3333-4444', 'limite_credito' => 30000.00],
    ['id' => 3, 'nome' => 'Atacadão Popular', 'cnpj_cpf' => '456.789.123-11', 'telefone' => '(11) 5555-6666', 'limite_credito' => 100000.00],
    ['id' => 4, 'nome' => 'Supermercado Econômico', 'cnpj_cpf' => '111.222.333-44', 'telefone' => '(11) 7777-8888', 'limite_credito' => 25000.00],
    ['id' => 5, 'nome' => 'Atacado São Paulo', 'cnpj_cpf' => '555.666.777-88', 'telefone' => '(11) 9999-0000', 'limite_credito' => 75000.00],
    ['id' => 6, 'nome' => 'Mercado Preço Baixo', 'cnpj_cpf' => '222.333.444-55', 'telefone' => '(11) 2222-3333', 'limite_credito' => 20000.00],
    ['id' => 7, 'nome' => 'Super Atacado', 'cnpj_cpf' => '333.444.555-66', 'telefone' => '(11) 4444-5555', 'limite_credito' => 80000.00],
    ['id' => 8, 'nome' => 'Atacadista Express', 'cnpj_cpf' => '444.555.666-77', 'telefone' => '(11) 6666-7777', 'limite_credito' => 60000.00],
    ['id' => 9, 'nome' => 'Mercado do Povo', 'cnpj_cpf' => '666.777.888-99', 'telefone' => '(11) 8888-9999', 'limite_credito' => 35000.00],
    ['id' => 10, 'nome' => 'Supermercado Ideal', 'cnpj_cpf' => '777.888.999-00', 'telefone' => '(11) 1010-2020', 'limite_credito' => 28000.00]
];

$produtos = [
    ['id' => 1, 'nome' => 'Arroz Tio João 5kg', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 50, 'preco_venda' => 22.90],
    ['id' => 2, 'nome' => 'Feijão Carioca Kicaldo 1kg', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 40, 'preco_venda' => 8.90],
    ['id' => 3, 'nome' => 'Açúcar União 1kg', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 30, 'preco_venda' => 3.90],
    ['id' => 4, 'nome' => 'Café Pilão 500g', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 60, 'preco_venda' => 18.90],
    ['id' => 5, 'nome' => 'Óleo de Soja Liza 900ml', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 45, 'preco_venda' => 7.90],
    ['id' => 6, 'nome' => 'Farinha de Trigo Dona Benta 1kg', 'categoria' => 'Grãos e Cereais', 'estoque_minimo' => 35, 'preco_venda' => 4.90],
    ['id' => 7, 'nome' => 'Macarrão Espaguete Adria 500g', 'categoria' => 'Massas', 'estoque_minimo' => 55, 'preco_venda' => 3.50],
    ['id' => 8, 'nome' => 'Leite em Pó Italac 400g', 'categoria' => 'Laticínios', 'estoque_minimo' => 25, 'preco_venda' => 12.90],
    ['id' => 9, 'nome' => 'Manteiga Aviação 200g', 'categoria' => 'Laticínios', 'estoque_minimo' => 20, 'preco_venda' => 8.90],
    ['id' => 10, 'nome' => 'Queijo Mussarela Sadia 1kg', 'categoria' => 'Frios e Embutidos', 'estoque_minimo' => 15, 'preco_venda' => 32.90]
];

$categorias = [
    ['id' => 1, 'nome' => 'Alimentos', 'pai' => ''],
    ['id' => 2, 'nome' => 'Bebidas', 'pai' => ''],
    ['id' => 3, 'nome' => 'Limpeza', 'pai' => ''],
    ['id' => 4, 'nome' => 'Higiene', 'pai' => ''],
    ['id' => 5, 'nome' => 'Grãos e Cereais', 'pai' => 'Alimentos'],
    ['id' => 6, 'nome' => 'Laticínios', 'pai' => 'Alimentos'],
    ['id' => 7, 'nome' => 'Frios e Embutidos', 'pai' => 'Alimentos'],
    ['id' => 8, 'nome' => 'Refrigerantes', 'pai' => 'Bebidas'],
    ['id' => 9, 'nome' => 'Cervejas', 'pai' => 'Bebidas'],
    ['id' => 10, 'nome' => 'Detergentes', 'pai' => 'Limpeza']
];

$movimentacoes = [
    ['id' => 1, 'produto' => 'Arroz Tio João 5kg', 'tipo' => 'ENTRADA', 'quantidade' => 200, 'data' => '2024-01-15 08:30:00', 'observacao' => 'Entrada inicial de estoque'],
    ['id' => 2, 'produto' => 'Feijão Carioca Kicaldo 1kg', 'tipo' => 'ENTRADA', 'quantidade' => 150, 'data' => '2024-01-15 09:15:00', 'observacao' => 'Entrada inicial de estoque'],
    ['id' => 3, 'produto' => 'Açúcar União 1kg', 'tipo' => 'ENTRADA', 'quantidade' => 100, 'data' => '2024-01-15 10:00:00', 'observacao' => 'Entrada inicial de estoque'],
    ['id' => 4, 'produto' => 'Café Pilão 500g', 'tipo' => 'ENTRADA', 'quantidade' => 300, 'data' => '2024-01-16 08:45:00', 'observacao' => 'Reposição de café'],
    ['id' => 5, 'produto' => 'Óleo de Soja Liza 900ml', 'tipo' => 'ENTRADA', 'quantidade' => 180, 'data' => '2024-01-16 09:30:00', 'observacao' => 'Reposição de óleo'],
    ['id' => 6, 'produto' => 'Arroz Tio João 5kg', 'tipo' => 'SAIDA', 'quantidade' => 50, 'data' => '2024-02-02 16:30:00', 'observacao' => 'Venda para Mercado Central'],
    ['id' => 7, 'produto' => 'Feijão Carioca Kicaldo 1kg', 'tipo' => 'SAIDA', 'quantidade' => 30, 'data' => '2024-02-02 16:35:00', 'observacao' => 'Venda para Mercado Central'],
    ['id' => 8, 'produto' => 'Açúcar União 1kg', 'tipo' => 'SAIDA', 'quantidade' => 20, 'data' => '2024-02-03 09:40:00', 'observacao' => 'Venda para Supermercado Bom Preço'],
    ['id' => 9, 'produto' => 'Café Pilão 500g', 'tipo' => 'SAIDA', 'quantidade' => 60, 'data' => '2024-02-05 14:20:00', 'observacao' => 'Venda para Atacadão Popular'],
    ['id' => 10, 'produto' => 'Óleo de Soja Liza 900ml', 'tipo' => 'SAIDA', 'quantidade' => 45, 'data' => '2024-02-06 11:10:00', 'observacao' => 'Venda para Supermercado Econômico']
];

$pedidos_compra = [
    ['id' => 1, 'numero' => 'PC20240115001', 'fornecedor' => 'Distribuidora Alimentícia Ltda', 'data_emissao' => '2024-01-15', 'entrega_prevista' => '2024-01-20', 'valor_total' => 12500.00, 'status' => 'RECEBIDO'],
    ['id' => 2, 'numero' => 'PC20240116001', 'fornecedor' => 'Bebidas do Brasil S.A.', 'data_emissao' => '2024-01-16', 'entrega_prevista' => '2024-01-19', 'valor_total' => 8900.00, 'status' => 'RECEBIDO'],
    ['id' => 3, 'numero' => 'PC20240117001', 'fornecedor' => 'Limpeza Total Indústria', 'data_emissao' => '2024-01-17', 'entrega_prevista' => '2024-01-24', 'valor_total' => 6700.00, 'status' => 'RECEBIDO'],
    ['id' => 4, 'numero' => 'PC20240118001', 'fornecedor' => 'Nestlé Brasil Ltda', 'data_emissao' => '2024-01-18', 'entrega_prevista' => '2024-01-22', 'valor_total' => 15300.00, 'status' => 'RECEBIDO'],
    ['id' => 5, 'numero' => 'PC20240119001', 'fornecedor' => 'Coca-Cola Femsa', 'data_emissao' => '2024-01-19', 'entrega_prevista' => '2024-01-21', 'valor_total' => 11200.00, 'status' => 'RECEBIDO'],
    ['id' => 6, 'numero' => 'PC20240122001', 'fornecedor' => 'Unilever Brasil Ltda', 'data_emissao' => '2024-01-22', 'entrega_prevista' => '2024-01-28', 'valor_total' => 9800.00, 'status' => 'RECEBIDO'],
    ['id' => 7, 'numero' => 'PC20240123001', 'fornecedor' => 'P&G Brasil Ltda', 'data_emissao' => '2024-01-23', 'entrega_prevista' => '2024-01-28', 'valor_total' => 7600.00, 'status' => 'RECEBIDO'],
    ['id' => 8, 'numero' => 'PC20240124001', 'fornecedor' => 'Ambev S.A.', 'data_emissao' => '2024-01-24', 'entrega_prevista' => '2024-01-27', 'valor_total' => 13400.00, 'status' => 'RECEBIDO'],
    ['id' => 9, 'numero' => 'PC20240125001', 'fornecedor' => 'Pepsico Brasil Ltda', 'data_emissao' => '2024-01-25', 'entrega_prevista' => '2024-01-29', 'valor_total' => 10500.00, 'status' => 'RECEBIDO'],
    ['id' => 10, 'numero' => 'PC20240126001', 'fornecedor' => 'Danone Brasil Ltda', 'data_emissao' => '2024-01-26', 'entrega_prevista' => '2024-01-31', 'valor_total' => 8200.00, 'status' => 'RECEBIDO']
];

$pedidos_venda = [
    ['id' => 1, 'numero' => 'PV20240115001', 'cliente' => 'Mercado Central', 'data_emissao' => '2024-01-15', 'data_entrega' => '2024-01-16', 'valor_total' => 4500.00, 'status' => 'ENTREGUE'],
    ['id' => 2, 'numero' => 'PV20240116001', 'cliente' => 'Supermercado Bom Preço', 'data_emissao' => '2024-01-16', 'data_entrega' => '2024-01-17', 'valor_total' => 3200.00, 'status' => 'ENTREGUE'],
    ['id' => 3, 'numero' => 'PV20240117001', 'cliente' => 'Atacadão Popular', 'data_emissao' => '2024-01-17', 'data_entrega' => '2024-01-18', 'valor_total' => 7800.00, 'status' => 'ENTREGUE'],
    ['id' => 4, 'numero' => 'PV20240118001', 'cliente' => 'Supermercado Econômico', 'data_emissao' => '2024-01-18', 'data_entrega' => '2024-01-19', 'valor_total' => 2900.00, 'status' => 'ENTREGUE'],
    ['id' => 5, 'numero' => 'PV20240119001', 'cliente' => 'Atacado São Paulo', 'data_emissao' => '2024-01-19', 'data_entrega' => '2024-01-20', 'valor_total' => 5600.00, 'status' => 'ENTREGUE'],
    ['id' => 6, 'numero' => 'PV20240122001', 'cliente' => 'Mercado Preço Baixo', 'data_emissao' => '2024-01-22', 'data_entrega' => '2024-01-23', 'valor_total' => 2100.00, 'status' => 'ENTREGUE'],
    ['id' => 7, 'numero' => 'PV20240123001', 'cliente' => 'Super Atacado', 'data_emissao' => '2024-01-23', 'data_entrega' => '2024-01-24', 'valor_total' => 6700.00, 'status' => 'ENTREGUE'],
    ['id' => 8, 'numero' => 'PV20240124001', 'cliente' => 'Atacadista Express', 'data_emissao' => '2024-01-24', 'data_entrega' => '2024-01-25', 'valor_total' => 3800.00, 'status' => 'ENTREGUE'],
    ['id' => 9, 'numero' => 'PV20240125001', 'cliente' => 'Mercado do Povo', 'data_emissao' => '2024-01-25', 'data_entrega' => '2024-01-26', 'valor_total' => 4900.00, 'status' => 'ENTREGUE'],
    ['id' => 10, 'numero' => 'PV20240126001', 'cliente' => 'Supermercado Ideal', 'data_emissao' => '2024-01-26', 'data_entrega' => '2024-01-27', 'valor_total' => 2700.00, 'status' => 'ENTREGUE']
];

// Determina a página atual
$pagina = $_GET['pagina'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noite-a-Noite - Sistema de Estoque</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { background: #f8f9fa; color: #333; line-height: 1.6; }
        
        .navbar { background: linear-gradient(135deg, #1e3c72, #2a5298); padding: 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .nav-logo h2 { color: #fff; font-size: 28px; padding: 15px 0; font-weight: 700; }
        .nav-logo span { color: #ffd700; }
        .nav-menu { display: flex; list-style: none; }
        .nav-menu li { position: relative; }
        .nav-menu a { color: #fff; text-decoration: none; padding: 20px 15px; display: block; transition: 0.3s; font-weight: 500; }
        .nav-menu a:hover, .nav-menu a.active { background: rgba(255,255,255,0.1); }
        
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu { display: none; position: absolute; background: #2a5298; min-width: 200px; z-index: 1000; border-radius: 0 0 5px 5px; }
        .dropdown-menu a { padding: 12px 15px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        
        .main-content { min-height: calc(100vh - 120px); padding: 30px 0; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
        
        .dashboard-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border-left: 4px solid #2a5298; }
        .card h3 { color: #2a5298; margin-bottom: 10px; font-size: 1.1rem; }
        .card .number { font-size: 2.5rem; font-weight: bold; color: #1e3c72; }
        .card .description { color: #666; font-size: 0.9rem; }
        
        .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        .action-btn { background: white; padding: 20px; border-radius: 8px; text-decoration: none; color: #333; text-align: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: 0.3s; border: 2px solid transparent; }
        .action-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); border-color: #2a5298; }
        .action-btn .icon { font-size: 2rem; margin-bottom: 10px; color: #2a5298; }
        
               .form-section, .table-section { background: white; padding: 30px; margin-bottom: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .section-title { color: #1e3c72; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e9ecef; font-weight: 600; }
        
        .crud-form { display: grid; gap: 15px; max-width: 600px; }
        .crud-form input, .crud-form select, .crud-form textarea { padding: 12px; border: 1px solid #ddd; border-radius: 5px; width: 100%; font-size: 14px; }
        .crud-form button { padding: 12px 30px; background: #2a5298; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .crud-form button:hover { background: #1e3c72; }
        
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        .data-table th, .data-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e9ecef; }
        .data-table th { background: #f8f9fa; font-weight: 600; color: #1e3c72; }
        .data-table tr:hover { background: #f8f9fa; }
        
        .status-badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .status-aberto { background: #d4edda; color: #155724; }
        .status-recebido { background: #cce5ff; color: #004085; }
        .status-cancelado { background: #f8d7da; color: #721c24; }
        .status-orcamento { background: #fff3cd; color: #856404; }
        .status-aprovado { background: #d1ecf1; color: #0c5460; }
        .status-faturado { background: #d4edda; color: #155724; }
        .status-entregue { background: #cce5ff; color: #004085; }
        
        .footer { background: #1e3c72; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; }
        
        @media (max-width: 768px) {
            .nav-container { flex-direction: column; padding: 10px; }
            .nav-menu { flex-direction: column; width: 100%; margin: 10px 0; }
            .dashboard-cards { grid-template-columns: 1fr; }
            .quick-actions { grid-template-columns: 1fr; }
            .data-table { font-size: 12px; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>🏪 <span>Noite-a-Noite</span> Atacadista</h2>
            </div>
            
            <ul class="nav-menu">
                <li><a href="?pagina=dashboard" class="<?= $pagina == 'dashboard' ? 'active' : '' ?>">📊 Dashboard</a></li>
                <li class="dropdown">
                    <a href="?pagina=produtos" class="<?= in_array($pagina, ['produtos', 'categorias', 'movimentacoes']) ? 'active' : '' ?>">📦 Estoque</a>
                    <ul class="dropdown-menu">
                        <li><a href="?pagina=produtos">Produtos</a></li>
                        <li><a href="?pagina=categorias">Categorias</a></li>
                        <li><a href="?pagina=movimentacoes">Movimentações</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="?pagina=compras" class="<?= in_array($pagina, ['compras', 'fornecedores']) ? 'active' : '' ?>">🛒 Compras</a>
                    <ul class="dropdown-menu">
                        <li><a href="?pagina=fornecedores">Fornecedores</a></li>
                        <li><a href="?pagina=compras">Pedidos de Compra</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="?pagina=vendas" class="<?= in_array($pagina, ['vendas', 'clientes']) ? 'active' : '' ?>">💰 Vendas</a>
                    <ul class="dropdown-menu">
                        <li><a href="?pagina=clientes">Clientes</a></li>
                        <li><a href="?pagina=vendas">Pedidos de Venda</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <?php
            switch($pagina) {
                case 'dashboard':
                    includeDashboard();
                    break;
                case 'produtos':
                    includeProdutos();
                    break;
                case 'categorias':
                    includeCategorias();
                    break;
                case 'movimentacoes':
                    includeMovimentacoes();
                    break;
                case 'fornecedores':
                    includeFornecedores();
                    break;
                case 'compras':
                    includeCompras();
                    break;
                case 'clientes':
                    includeClientes();
                    break;
                case 'vendas':
                    includeVendas();
                    break;
                default:
                    includeDashboard();
            }
            ?>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>🏪 Noite-a-Noite Atacadista &copy; 2024 - Sistema de Gestão de Estoque</p>
        </div>
    </footer>
</body>
</html>

<?php
// =============================================
// FUNÇÕES DAS PÁGINAS
// =============================================

function includeDashboard() {
    global $produtos, $clientes, $fornecedores, $pedidos_compra;
    ?>
    <div class="dashboard-cards">
        <div class="card">
            <h3>📦 Total de Produtos</h3>
            <div class="number">10</div>
            <div class="description">10 produtos cadastrados</div>
        </div>
        <div class="card">
            <h3>👥 Clientes Cadastrados</h3>
            <div class="number">10</div>
            <div class="description">10 clientes ativos</div>
        </div>
        <div class="card">
            <h3>🏭 Fornecedores</h3>
            <div class="number">10</div>
            <div class="description">10 fornecedores parceiros</div>
        </div>
        <div class="card">
            <h3>📋 Pedidos Pendentes</h3>
            <div class="number">0</div>
            <div class="description">0 pedidos em aberto</div>
        </div>
    </div>
    
    <div class="quick-actions">
        <a href="?pagina=produtos" class="action-btn">
            <div class="icon">📦</div>
            <div>Cadastrar Produto</div>
        </a>
        <a href="?pagina=movimentacoes" class="action-btn">
            <div class="icon">🔄</div>
            <div>Movimentar Estoque</div>
        </a>
        <a href="?pagina=compras" class="action-btn">
            <div class="icon">🛒</div>
            <div>Novo Pedido Compra</div>
        </a>
        <a href="?pagina=vendas" class="action-btn">
            <div class="icon">💰</div>
            <div>Novo Pedido Venda</div>
        </a>
    </div>
    
    <div class="table-section">
        <h3 class="section-title">📊 Últimas Movimentações</h3>
        <?php
        global $movimentacoes;
        $ultimas_movimentacoes = array_slice($movimentacoes, 0, 5);
        ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ultimas_movimentacoes as $mov): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($mov['data'])) ?></td>
                    <td><?= htmlspecialchars($mov['produto']) ?></td>
                    <td>
                        <span class="status-badge <?= $mov['tipo'] == 'ENTRADA' ? 'status-recebido' : 'status-cancelado' ?>">
                            <?= $mov['tipo'] ?>
                        </span>
                    </td>
                    <td><?= $mov['quantidade'] ?></td>
                    <td><?= htmlspecialchars($mov['observacao']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeProdutos() {
    global $produtos;
    ?>
    <div class="form-section">
        <h3 class="section-title">➕ Cadastrar Novo Produto</h3>
        <form method="POST" class="crud-form">
            <input type="text" name="nome" placeholder="Nome do produto" required>
            <input type="text" name="codigo_barras" placeholder="Código de barras">
            <select name="categoria_id">
                <option value="">Selecione a categoria</option>
                <option value="1">Alimentos</option>
                <option value="2">Bebidas</option>
                <option value="3">Limpeza</option>
                <option value="4">Higiene</option>
            </select>
            <input type="number" name="estoque_minimo" placeholder="Estoque mínimo" min="0" value="0">
            <input type="number" name="preco_venda" placeholder="Preço de venda" step="0.01" min="0" value="0">
            <button type="submit">📦 Cadastrar Produto</button>
        </form>
    </div>
    
    <div class="table-section">
        <h3 class="section-title">📋 Lista de Produtos</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Estoque Mín.</th>
                    <th>Preço Venda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $prod): ?>
                <tr>
                    <td><?= $prod['id'] ?></td>
                    <td><strong><?= htmlspecialchars($prod['nome']) ?></strong></td>
                    <td><?= htmlspecialchars($prod['categoria']) ?></td>
                    <td><?= $prod['estoque_minimo'] ?></td>
                    <td>R$ <?= number_format($prod['preco_venda'], 2, ',', '.') ?></td>
                    <td>
                        <span class="status-badge status-aberto">ATIVO</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeCategorias() {
    global $categorias;
    ?>
    <div class="table-section">
        <h3 class="section-title">📂 Categorias de Produtos</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria Pai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><strong><?= htmlspecialchars($cat['nome']) ?></strong></td>
                    <td><?= $cat['pai'] ?: 'Principal' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeMovimentacoes() {
    global $movimentacoes;
    ?>
    <div class="table-section">
        <h3 class="section-title">🔄 Histórico de Movimentações</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movimentacoes as $mov): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($mov['data'])) ?></td>
                    <td><?= htmlspecialchars($mov['produto']) ?></td>
                    <td>
                        <span class="status-badge <?= $mov['tipo'] == 'ENTRADA' ? 'status-recebido' : 'status-cancelado' ?>">
                            <?= $mov['tipo'] ?>
                        </span>
                    </td>
                    <td><?= $mov['quantidade'] ?></td>
                    <td><?= htmlspecialchars($mov['observacao']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeFornecedores() {
    global $fornecedores;
    ?>
    <div class="table-section">
        <h3 class="section-title">🏭 Fornecedores Cadastrados</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Prazo Entrega</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores as $forn): ?>
                <tr>
                    <td><?= $forn['id'] ?></td>
                    <td><strong><?= htmlspecialchars($forn['nome']) ?></strong></td>
                    <td><?= htmlspecialchars($forn['cnpj']) ?></td>
                    <td><?= htmlspecialchars($forn['telefone']) ?></td>
                    <td><?= htmlspecialchars($forn['email']) ?></td>
                    <td><?= $forn['prazo_entrega'] ?> dias</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeCompras() {
    global $pedidos_compra;
    ?>
    <div class="table-section">
        <h3 class="section-title">🛒 Pedidos de Compra</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Fornecedor</th>
                    <th>Data Emissão</th>
                    <th>Entrega Prevista</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos_compra as $pedido): ?>
                <tr>
                    <td><?= htmlspecialchars($pedido['numero']) ?></td>
                    <td><?= htmlspecialchars($pedido['fornecedor']) ?></td>
                    <td><?= date('d/m/Y', strtotime($pedido['data_emissao'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($pedido['entrega_prevista'])) ?></td>
                    <td>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></td>
                    <td>
                        <span class="status-badge status-<?= strtolower($pedido['status']) ?>">
                            <?= $pedido['status'] ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeClientes() {
    global $clientes;
    ?>
    <div class="table-section">
        <h3 class="section-title">👥 Clientes Cadastrados</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ/CPF</th>
                    <th>Telefone</th>
                    <th>Limite Crédito</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><strong><?= htmlspecialchars($cliente['nome']) ?></strong></td>
                    <td><?= htmlspecialchars($cliente['cnpj_cpf']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                    <td>R$ <?= number_format($cliente['limite_credito'], 2, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function includeVendas() {
    global $pedidos_venda;
    ?>
    <div class="table-section">
        <h3 class="section-title">💰 Pedidos de Venda</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Cliente</th>
                    <th>Data Emissão</th>
                    <th>Data Entrega</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos_venda as $pedido): ?>
                <tr>
                    <td><?= htmlspecialchars($pedido['numero']) ?></td>
                    <td><?= htmlspecialchars($pedido['cliente']) ?></td>
                    <td><?= date('d/m/Y', strtotime($pedido['data_emissao'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($pedido['data_entrega'])) ?></td>
                    <td>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></td>
                    <td>
                        <span class="status-badge status-<?= strtolower($pedido['status']) ?>">
                            <?= $pedido['status'] ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>