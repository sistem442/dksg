<?

  class RSS
  {
	public function RSS()
	{
		require_once ('../database_connect.php');
	}

	public function GetFeed()
	{
		return $this->getDetails() . $this->getItems();
	}

	private function dbConnect()
	{
		DEFINE ('LINK', mysql_connect('localhost','admin','admin'));
	}

	private function getDetails()
	{
		$detailsTable = "event";
		$this->dbConnect($detailsTable);
		$query = "SELECT * FROM ". $detailsTable;
		$result = mysql_db_query (DB_NAME, $query, LINK);

		while($row = mysql_fetch_array($result))
		{
			$details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
				<rss version="2.0">
					<channel>
						<title>'. $row['imePrograma'] .'</title>
						<link>'. $row['http://www.dksg.rs/oneEventDisplay.php?id='] .$row['id'].'</link>
						<description>'. $row['skrTekst'] .'</description>
						<image>
							<url>'. $row['slika'] .'</url>
							<link>'. $row['slika'] .'</link>
						</image>';
		}
		return $details;
	}

	private function getItems()
	{
		$itemsTable = "webref_rss_items";
		$this->dbConnect($itemsTable);
		$query = "SELECT * FROM ". $itemsTable;
		$result = mysql_db_query (DB_NAME, $query, LINK);
		$items = '';
		while($row = mysql_fetch_array($result))
		{
			$items .= '<item>
				<title>'. $row["imePrograma"] .'</title>
				<link>'. $row["http://www.dksg.rs/oneEventDisplay.php?id="] .$row['id'] .'</link>
				<description><![CDATA['. $row["skrTekst"] .']]></description>
			</item>';
		}
		$items .= '</channel>
				</rss>';
		return $items;
	}

}

?>