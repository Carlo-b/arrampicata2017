<?php

/**
 * Class Admin
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 */
class Admin extends Controller
{
	/**
	 * NON CREDO FACCIA QUESTO...
	 * PAGINA: selezionaboulder
	 * Questo metodo reindirizza l'arbitro alla selezione del boulder, ho aggiunto questo metodo invece che lasciare solo
	 * selezionaboulder() così l'arbitro raggiunge quella pagina usando un URL più breve (http://<indirizzo>:<porta>/gara), e il metodo
	 * index è richiesto per evitare errori
	 */
	public function index()
	{
		header('location: ' . URL . 'admin/aggiungistudente');
	}

	/**
	 * La funzione permette di aggiungere uno studente
	 */
	public function aggiungistudente()
	{
		if (isset($_POST["name"]) && isset($_POST["cognome"]))
		{
			$nome = $_POST["name"];
			$cognome = $_POST["cognome"];
			$sesso = $_POST["sesso"];
			$data_nascita = $_POST["data_nascita"];
			$id_scuola = $_POST["scuola"];
			$this->model->addAtleta($nome, $cognome, $data_nascita, $sesso, $id_scuola);
		}
		require APP . 'view/admin/menu.php';
		require APP . 'view/admin/aggiungistudente.php';
	}

	/**
	 * La funzione mostra la classifica
	 */
	public function classifica()
	{
		require APP . 'view/admin/classifica.php';
	}

	public function classificaSquadre($categoria)
	{

		switch ($categoria)
		{
			case "allieviM":
			{
				$anno_min = 1999;
				$anno_max = 2001;
				$sesso = "M";
				$cat = "Allievi Maschile";
				break;
			}
			case "allieviF":
			{
				$anno_min = 1999;
				$anno_max = 2001;
				$sesso = "F";
				$cat = "Allievi Femminile";
				break;
			}
			case "junioresM":
			{
				$anno_min = 1997;
				$anno_max = 1998;
				$sesso = "M";
				$cat = "Juniores Maschile";
				break;
			}
			case "junioresF":
			{
				$anno_min = 1997;
				$anno_max = 1998;
				$sesso = "F";
				$cat = "Juniores Femminile";
				break;
			}
		}
		$punteggi = array();
		for ($i=1; $i <= $this->model->getNumeroScuole() ; $i++)
		{
			if( $this->model->getIscritti($i,$anno_min,$anno_max,$sesso)>=3)
			{
				$podio = $this->model->getPodio($i,$anno_min,$anno_max,$sesso);
				$pos1=$podio->fetch();
				$pos2=$podio->fetch();
				$pos3=$podio->fetch();
				$sum=0;
				$classifica=$this->model->getClassificaGlobal($anno_min,$anno_max,$sesso);
				foreach ( $classifica as $row)
				{
					if($row->id==$pos1->id or $row->id==$pos2->id or $row->id==$pos3->id)
						$sum+=$row->posizione;
				}
				$punteggi[$i]=$sum;
			}

		}
		require APP . 'view/admin/classificasquadre.php';
}

	/**
	 * La funzione che genera una tabella html contente i dati della classifica
	 */
	public function generaClassifica($categoria)
	{
		/**$valBoulders = $this->model->getValBoulders();
		$pettorine=$this->model->getAllPettorine();
		foreach ( $pettorine as $pettorina)
		{
			$this->aggiornaPunteggioAtleta($pettorina->casacca,$valBoulders);
		}*/

		switch ($categoria)
		{
			case "allieviM":
				$classifica = $this->model->getClassificaPivot(1999,2001,"M");
				break;
			case "allieviF":
				$classifica = $this->model->getClassificaPivot(1999,2001,"F");
				break;
			case "junioresM":
				$classifica = $this->model->getClassificaPivot(1997,1998,"M");
				break;
			case "junioresF":
				$classifica = $this->model->getClassificaPivot(1997,1998,"F");
				break;

		}
		foreach ($classifica as $row)
		{
			echo <<<EOT
			<tr>
				<td><strong>$row->posizione</strong></td>
				<td><strong>$row->cognome</strong></td>
				<td><strong>$row->nome</strong></td>
				<td><strong>$row->punteggio</strong></td>
EOT;
			echo "<td>";
			for ($i = 1; $i <= 10 ; $i++)
			{
				if($row->$i==1)
					echo "<span class=\"fa-stack fa-1x\">
  								<i class=\"fa fa-circle fa-stack-2x passed\"></i>
  								<strong class=\"fa-stack-1x fa-inverse\">".$i."</strong>
								</span>";
				else
				{
					echo "<span class=\"fa-stack fa-1x\">
  								<i class=\"fa fa-circle fa-stack-2x notpassed\"></i>
  								<strong class=\"fa-stack-1x fa-inverse\">".$i."</strong>
								</span>";
				}

			}
			echo "</td></tr>";
		}
	}

	/**
	 * Funzione che calcola il punteggio di un atleta data una casacca e un array nome_boulder=>valore come parametri
	 * Non più necessaria si può rimuovere?
	 */
	public function aggiornaPunteggioAtleta($casacca,$valBoulders)
	{
		$tentativi = $this->model->getTentativi($casacca);
		$punteggio = 0;
		foreach ($tentativi as $prova)
		{
			$punteggio += $valBoulders[$prova->boulder] / $prova->tentativi;
			// in caso serva vedere come vengono eseguiti i calcoli
			//echo "boulder".$prova->boulder."  valore:".$valBoulders[$prova->boulder]."  Punteggio atleta:".$punteggio."</br>";
		}
		//echo $punteggio;
		$this->model->addPunteggio($casacca, $punteggio);
	}

	/**
	 * Questa funzione reindirizza alla pagina di creazione e visione delle pettorine
	 */
	public function generaPettorine()
	{
		$lista_pettorine = $this->model->getElencoPettorine();
		require APP . 'view/admin/menu.php';
		require APP . 'view/admin/pettorine.php';
	}

	/**
	* Generazione dell'elenco
	*/
	public function elenco()
	{
		require APP . 'view/admin/menu.php';
		require APP . 'view/admin/elenco.php';
	}

	/**
	 * Questa funzione reindirizza alla pagina di correzione
	 */
	public function correzione()
	{
		if(isset($_POST['correzione_dati'])){
			$pettorina = $_POST['numero_pettorina'];
			$tentativi = $_POST['n_tentativi'];
			$id_boulder = $_POST['id_boulder'];
			$passato = $_POST['passato'];
			$this->model->aggiustaTentativo($id_boulder,$pettorina,$tentativi,$passato);
		}
		$prova = $this->model->getAllPettorine();
		require APP . 'view/admin/menu.php';
		require APP . 'view/admin/correzione.php';
	}

	/**
	* Funzione che permette l'accesso allo script per la generazione dell'elenco
	*/
	public function prova()
	{
		require APP . 'view/admin/generaelenco.php';
	}


	/**
	 * -->FUNZIONE DA CHIAMARE PRIMA DELLA GARA<----
	 * Funzione necessaria ad inizializzare la tabella atleta_boulder
	 * in modo da poter visualizzare in classifica anche gli atleti
	 * che non hanno passato alcun boulder
	 * ATTENZIONE NON CHIAMARE LA FUNZIONE A GARA INIZIATA, PENA AZZERAMENTO DELLA CLASSIFICA
	 */
	public function initializeGara()
	{
		$atleti=$this->model->getAllAtleti();
		foreach ($atleti as $atleta)
		{
			for ($i=1; $i <=10 ; $i++)
			{
				$this->model->addTentativo($i,$atleta->casacca,0,'N');
			}
		}
		echo "finito :)" ;
	}

}
