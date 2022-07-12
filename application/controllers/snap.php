

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('checkout_snap');
    }

    public function token()
    {
        $jumlah_angsuran = $this->input->post('jumlah_angsuran');
        $total = $this->input->post('total');
        $fullname = $this->input->post('fullname');
        $bil1 = $this->input->post('bil1');
        $bil2 = $this->input->post('bil2');

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $total, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => rand(000, 999),
            'price' => $bil2,
            'quantity' => $bil1,
            'name' => 'Pembayaran Angsuran'
        );

        // Optional


        // Optional
        $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => $fullname,
            'last_name'     => "a",
            'address'       => "a",
            'city'          => "a",
            'postal_code'   => "a",
            'phone'         => "a",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => $fullname,
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $fullname,
            'last_name'     => "",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 60
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->input->post('result_data'));
        dead($result);
    }
}
