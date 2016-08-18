<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename="dbbackup.sql.gz"');
passthru("mysqldump --user=root --host=127.0.0.1 --password=calors adv | gzip");

class Backup extends CI_Controller {

	public function index()
	{
// Load the DB utility class
		$this->load->dbutil();

// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();

// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('bkp/mybackup.gz', $backup);

// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.gz', $backup);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */