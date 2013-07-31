<?php
// *
 
/**
 *
 * - Manipulacao de Data ou Hora.
 *
 * 		Operacoes: soma DIA, MES ,ANO, HORA, MINUTOS, SEGUNDOS.
 *		Formatos :
 *			Data: 15/01/2007
 *			Hora: 10:35:00
 * 		Para subtrair, basta passar um valor negativo:
 * 		Ex:
 * 			$obj->somaDia(-10);
 *
 * - Calcula diferenca entre duas datas.
 *
 * 		Operacoes: difDataHora.
 *		Formatos :
 *			Data: 15/01/2007 10:35:00
 * 		E necessario passar duas datas como parametro e o tipo de retorno desejado:
 * 		Ex:
 * 			$obj->difDataHora($dataMenor,$dataMaior,"m");
 *
 */
class Data_Hora
{
	private $data;
	private $hora;
 
	function CalcDataHora($data="",$hora="")
	{
		if($hora=="")
		{
			$hora = date("H:i:s");
		}
		if($data=="")
		{
			$data = date("d/m/Y ");
		}
		else if ($this->validaData($data,"d"))
		{
			die ("Padrao de data ($data) invalido! - Padrao = 15/01/2007");
		}
		$this->data = explode("/",$data);
		$this->hora = explode(":",$hora);
	}
	private function validaData($data,$op)
	{
		switch($op)
		{
			case "d": // Padrao: 15/01/2007
				$er = "(([0][1-9]|[1-2][0-9]|[3][0-1])\/([0][1-9]|[1][0-2])\/([0-9]{4}))";
				if(ereg($er,$data))
				{
					return 0;
				}
				else
				{
					return 1;
				}
				break;
			case "dh": // Padrao 15/01/2007 10:30:00
				$er = "(([0][1-9]|[1-2][0-9]|[3][0-1])\/([0][1-9]|[1][0-2])\/([0-9]{4})*)";
				if(ereg($er,$data))
				{
					return 0;
				}
				else
				{
					return 1;
				}
				break;
		}
	}
	// DATA
	public function somaDia($dias=1)
	{
		$this->CalcDataHora(strftime("%d/%m/%Y", mktime(0, 0, 0, $this->data[1], $this->data[0]+$dias, $this->data[2])),"");
		return $this->data;
	}
	public function somaMes($meses=1)
	{
		$this->CalcDataHora(strftime("%d/%m/%Y", mktime(0, 0, 0, $this->data[1]+$meses, $this->data[0], $this->data[2])),"");
		return $this->data;
	}
	public function somaAno($anos=1)
	{
		$this->CalcDataHora(strftime("%d/%m/%Y", mktime (0, 0, 0, $this->data[1], $this->data[0], $this->data[2]+$anos)),"");
		return $this->data;
	}
	public function getData()
	{
		return $this->data[0]."/".$this->data[1]."/".$this->data[2];
	}
	// HORA
	public function somaSegundo($segundos=1)
	{
		$this->CalcDataHora("",strftime("%H:%M:%S",mktime($this->hora[0],$this->hora[1],$this->hora[2]+$segundos, 0, 0, 0)));
		return $this->hora;
	}
	public function somaMinuto($minutos=1)
	{
		$this->CalcDataHora("",strftime("%H:%M:%S",mktime($this->hora[0],$this->hora[1]+$minutos,$this->hora[2], 0, 0, 0)));
		return $this->hora;
	}
	public function somaHora($horas=1)
	{
		$this->CalcDataHora("",strftime("%H:%M:%S",mktime($this->hora[0]+$horas,$this->hora[1],$this->hora[2], 0, 0, 0)));
		return $this->hora;
	}
	public function getHora()
	{
		return $this->hora[0].":".$this->hora[1].":".$this->hora[2];
	}
	
	
	
	/*	=======================================================================================================================	*/
	/*	SOMA DIAS COM UMA DATA ESPECIFICA	*/
	/*	Exemplo de uso: somaDiaDataEspecifica("01/03/2007", 2);	*/
	/*	=======================================================================================================================	*/
	public function somaDiaDataEspecifica($data, $qtd_dias)
	{
		$data = explode("/", $data);
		return strftime("%d/%m/%Y", mktime(0, 0, 0, $data[1], $data[0]+$qtd_dias, $data[2]));
		
	}
	
	
	
	/*	=======================================================================================================================	*/
	/*	RETORNA O DIA POR EXTENSO	*/
	/*	Exemplo de uso: diasemana("20070713");	*/
	/*	=======================================================================================================================	*/
	function diasemana($data) 
	{
		$ano =  substr("$data", 0, 4);
		$mes =  substr("$data", 4, 2);
		$dia =  substr("$data", 6, 2);
	
		$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	
		switch($diasemana) 
		{
			case"0": 
				return "Domingo";       
			break;
			case"1": 
				return "Segunda-Feira"; 
			break;
			case"2": 
				return "Terça-Feira";   
			break;
			case"3": 
				return "Quarta-Feira";  
			break;
			case"4": 
				return "Quinta-Feira";  
			break;
			case"5": 
				return "Sexta-Feira";   
			break;
			case"6": 
				return "Sábado";        
			break;
		}
	
	
	}


	
	/*	=======================================================================================================================	*/
	/*	RETORNA O DIA DA SEMANA PELO NUMERO, 0-domingo, 1-segunda, 2-terca	*/
	/*	Exemplo de uso: diasemana("20070713");	*/
	/*	=======================================================================================================================	*/
	function diasemananunmero($data) 
	{
		$ano =  substr("$data", 0, 4);
		$mes =  substr("$data", 4, 2);
		$dia =  substr("$data", 6, 2);
	
		return date("w", mktime(0,0,0,$mes,$dia,$ano) );
	}
	
	
	
	/*	=======================================================================================================================	*/
	/*	RETORNA A IDADE	*/
	/*	Exemplo de uso: verifica_idade("13/07/2007");	*/
	/*	=======================================================================================================================	*/
	function verifica_idade($data) 
	{
		// Separa em dia, mês e ano
		list($dia, $mes, $ano) = explode('/', $data);
	 
		// Descobre que dia é hoje e retorna a unix timestamp
		$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	
		// Descobre a unix timestamp da data de nascimento do fulano
		$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
	 
		// Depois apenas fazemos o cálculo já citado :)
		return $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
	}
	
	
	/*	=======================================================================================================================	*/
	/*	RETORNA O MES POR EXTENSO	*/
	/*	=======================================================================================================================	*/
	public function getMesExtenso($mes=1)
	{
		switch($mes)
		{
			case 1:
				$mes_extenso = "Janeiro";
			break;
			case 2:
				$mes_extenso = "Fevereiro";
			break;
			case 3:
				$mes_extenso = "Março";
			break;
			case 4:
				$mes_extenso = "Abril";
			break;
			case 5:
				$mes_extenso = "Maio";
			break;
			case 6:
				$mes_extenso = "Junho";
			break;
			case 7:
				$mes_extenso = "Julho";
			break;
			case 8:
				$mes_extenso = "Agosto";
			break;
			case 9:
				$mes_extenso = "Setembro";
			break;
			case 10:
				$mes_extenso = "Outubro";
			break;
			case 11:
				$mes_extenso = "Novembro";
			break;
			case 12:
				$mes_extenso = "Dezembro";
			break;
			
			//	CASO COLOQUE UM ZERO NA FRENT
			case 01:
				$mes_extenso = "Janeiro";
			break;
			case 02:
				$mes_extenso = "Fevereiro";
			break;
			case 03:
				$mes_extenso = "Março";
			break;
			case 04:
				$mes_extenso = "Abril";
			break;
			case 05:
				$mes_extenso = "Maio";
			break;
			case 06:
				$mes_extenso = "Junho";
			break;
			case 07:
				$mes_extenso = "Julho";
			break;
			case 08:
				$mes_extenso = "Agosto";
			break;
			case 09:
				$mes_extenso = "Setembro";
			break;
		}
		
		return $mes_extenso;
	}
 
 
	/**
	 *
	 * Retorna diferença entre as datas em Dias, Horas ou Minutos
	 * Function difDataHora(data menor, [data maior],[dias horas minutos segundos])
	 *
	 * Formato 04/05/2006 12:00:00
	 *
	 * Chame a funcao com o valor NULL como 'data maior' para 'data maior' = data atual.
	 *
	 * Formatacao do retorno [dias horas minutos segundos]:
	 *
	 * "s": Segundos
	 * "m": Minutos
	 * "H": Horas
	 * "h": Horas arredondada
	 * "D": Dias
	 * "d": Dias arredontados
	 *
	 */
	public function difDataHora($datamenor,$datamaior="",$tipo="")
	{
		if($this->validaData($datamenor,"dh"))
		{
			die ("data errada - $datamenor");
		}
		if($datamaior==""){
			$datamaior = date("d/m/Y H:i:s");
		}
		if($tipo==""){
			$tipo = "h";
		}
		list ($diamenor, $mesmenor, $anomenor, $horamenor, $minutomenor, $segundomenor) = split("[/: ]",$datamenor);
		list ($diamaior, $mesmaior, $anomaior, $horamaior, $minutomaior, $segundomaior) = split("[/: ]",$datamaior);
 
		$segundos =	mktime($horamaior,$minutomaior,$segundomaior,$mesmaior,$diamaior, $anomaior)-mktime($horamenor,$minutomenor,$segundomenor,$mesmenor,$diamenor, $anomenor);
 
		switch($tipo){
			case "s": // Segundo
				$diferenca = $segundos;
				break;
			case "m": // Minuto
				$diferenca = $segundos/60;
				break;
			case "H": // Hora
				$diferenca = $segundos/3600;
				break;
			case "h": // Hora Arredondada
				$diferenca = round($segundos/3600);
				break;
			case "D": // Dia
				$diferenca = $segundos/86400;
				break;
			case "d": // Dia Arredondado
				$diferenca = round($segundos/86400);
				break;
		}
		return $diferenca;
	}
}