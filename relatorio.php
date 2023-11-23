<?php
require_once 'core/init.php';

class Relatorio extends FPDF {

    
    private $_total;
    private $_mono;
    private $_tese;

    private $_diss;


    function Header() {
        $doc = new Document();
        $total = $doc->getTotal();
        $monografia = $doc->getTotalbyType('monografia');
        $tese = $doc->getTotalbyType('tese');
        $dissertacao = $doc->getTotalbyType('dissertacao');

        $this->_total = $total[0]->{'COUNT(*)'};
        $this->_mono = $monografia[0]->{'COUNT(*)'};
        $this->_tese = $tese[0]->{'COUNT(*)'};
        $this->_diss = $dissertacao[0]->{'COUNT(*)'};

        
        // Adicione uma imagem no topo da página
        $this->Image('./resources/img/logofet.png', 5, 20, 40);
        
        // Adicione o nome do sistema abaixo da imagem
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 20, utf8_decode('Repositório Científico da FET'), 0, 1, 'C');

       $this->Image('./resources/img/logoup.png', 165, 15, 20);
        $this->Ln(5);
        // Adicione um parágrafo com alguns dizeres
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 12, utf8_decode('O presente relatório apresenta dados estatísticos referentes ao Repositório Científico da FET. As informações contidas neste documento oferecem uma análise aprofundada do estado atual do sistema, destacando números significativos e proporcionando insights essenciais sobre a composição do repositório.
Ao explorar a tabela estatística fornecida, é possível visualizar de forma clara e concisa o número total de documentos armazenados no repositório, assim como a distribuição específica entre monografias, teses e dissertações. Esses dados estatísticos são fundamentais para compreender a diversidade e a amplitude do conteúdo científico disponível no âmbito da FET.
        .'));

        // Adicione uma quebra de linha
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }

    function Conteudo($dados) {
        // Adicione uma tabela estatística
        $this->Ln(4);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Tabela Estatística'), 0, 1, 'C');

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, utf8_decode('Nr total de documentos: '.$this->_total), 0, 1);
        $this->Cell(0, 10, utf8_decode('Número de Monografias: '.$this->_mono), 0, 1);
        $this->Cell(0, 10, utf8_decode('Número de Teses: '.$this->_tese), 0, 1);
        $this->Cell(0, 10, utf8_decode('Número de Dissertações: '.$this->_diss), 0, 1);

        // Adicione uma quebra de linha antes da linha no centro
        $this->Ln(30);

        // Adicione uma linha no centro
        $this->Line(40, $this->GetY(), 170, $this->GetY());

        // Adicione o Nome do Administrador do Sistema abaixo da linha
        $this->Ln(10);
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, utf8_decode(''), 0, 1, 'C');
    }
}

$dados_relatorio = [
    'Linha 1 do relatório',
    'Linha 2 do relatório',
    'Linha 3 do relatório',
];

$pdf = new Relatorio();
$pdf->AddPage();
$pdf->Conteudo($dados_relatorio);
$pdf->Output();
?> 
