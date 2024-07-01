<?php
	require('pdf/fpdf.php');
	class formato extends FPDF{
		var $widths;
		var $aligns;
 
        // === ENCABEZADO ====
       function Header()
       {

          $this->Image('Imagenes/zoo.jpg',10,8,33);
          $this->SetFont('Arial','B',12);
         $this->Cell(230,10,'Zoologico de Pánuco Veracruz',0,0,'C');

       }

       // === PIE DE PAGINA
	function Footer()
	{
	$this->SetY(-10);
	$this->SetFont('Arial','I',8);
	$this->Cell(0,10,'Página '.$this->PageNo().'----- ITSP: Reporte de datos ----',0,0,'C');
  }



		function SetWidths($w){
			$this->widths=$w;
		}

		function SetAligns($a){
			$this->aligns=$a;
		}

		function Columnas($columnas){
			$this->SetFont('Arial','B',14);
	    	foreach($columnas as $col)
	    		$this->Cell(70,7,$col,1,0,'C');
	    	$this->Ln();
	    }
		
		
		
		function AnchoColumna($columnas,$ancho,$alineacion){
			$this->SetFont('Arial','B',8);
	    	foreach($columnas as $col)
	    		$this->Cell($ancho,7,$col,1,0,$alineacion);
	    	//$this->Ln();
	    }
		
		function Columnas20($columnas){
			$this->SetFont('Arial','B',14);
	    	foreach($columnas as $col)
	    		$this->Cell(20,7,$col,1,0,'C');
	    	//$this->Ln();
	    }
		function Columnas30($columnas){
			$this->SetFont('Arial','B',14);
	    	foreach($columnas as $col)
	    		$this->Cell(30,7,$col,1,0,'C');
	    	//$this->Ln();
	    }
		function Columnas40($columnas){
			$this->SetFont('Arial','B',8);
	    	foreach($columnas as $col)
	    		$this->Cell(40,7,$col,1,0,'C');
	    	//$this->Ln();
	    }
		function Columnas100($columnas){
			$this->SetFont('Arial','B',14);
	    	foreach($columnas as $col)
	    		$this->Cell(100,7,$col,1,0,'C');
	    	//$this->Ln();
	    }
		

		function Fila($data){
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=5*$nb;
			$this->CheckPageBreak($h);
			for($i=0;$i<count($data);$i++){
				$w = $this->widths[$i];
				$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
				$x=$this->GetX();
				$y=$this->GetY();
				$this->Rect($x,$y,$w,$h);
				$this->MultiCell($w,5,$data[$i],0,$a);
				$this->SetXY($x+$w,$y);
			}
			$this->Ln($h);
		}

		function CheckPageBreak($h){
			if($this->GetY()+$h>$this->PageBreakTrigger)
				$this->AddPage($this->CurOrientation);
		}

		function NbLines($w,$txt){
			$cw=&$this->CurrentFont['cw'];
			if($w==0)
				$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n"){
				$nb--;
			}
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
			while($i<$nb){
				$c=$s[$i];
				if($c=="\n"){
					$i++;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
					continue;
				}
				if($c==' ')
					$sep=$i;
				$l+=$cw[$c];
				if($l>$wmax){
					if($sep==-1){
						if($i==$j)
							$i++;
					}else{
						$i=$sep+1;
					}
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
				}else{
					$i++;
				}
			}
			return $nl;
		}

		function RoundedRect($x, $y, $w, $h, $r, $style = ''){
			$k = $this->k;
			$hp = $this->h;
			if($style=='F')
				$op='f';
			elseif($style=='FD' || $style=='DF')
				$op='B';
			else
				$op='S';
			$MyArc = 4/3 * (sqrt(2) - 1);
			$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
			$xc = $x+$w-$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

			$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
			$xc = $x+$w-$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
			$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
			$xc = $x+$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
			$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
			$xc = $x+$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
			$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
			$this->_out($op);
		}

		function _Arc($x1, $y1, $x2, $y2, $x3, $y3){
			$h = $this->h;
			$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
				$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
		}
	}
?>