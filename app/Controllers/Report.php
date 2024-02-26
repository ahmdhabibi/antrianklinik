<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;

use App\Controllers\BaseController;

use App\Libraries\MY_TCPDF as TCPDF;

class Report extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->antrian = new AntrianPelayananModel();
        $this->lookAntrian = new LookAntrianModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $dataInput = $this->request->getVar();
        $pelayanan = $this->pelayanan->findAll();
        if (empty($dataInput)) {
            $awal = '2023-01-28';
            $akhir = date('Y-m-d');
            $dataAntrian = [];
            foreach ($pelayanan as $p) {
                $dataAntrian[$p->jenis] = $this->antrian->reportAntrianByPelayanan($p->id, $awal, $akhir)->getResult();
            }
        } else {
            $awal = $dataInput['tgl_awal'];
            $akhir = $dataInput['tgl_akhir'];
            $dataAntrian = [];
            foreach ($pelayanan as $p) {
                $dataAntrian[$p->jenis] = $this->antrian->reportAntrianByPelayanan($p->id, $awal, $akhir)->getResult();
            }
        }
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Report',
            'nama_submenu' => '',
            'heading' => 'Report Kinerja Pelayanan',
            'tittle' => 'Halaman Laporan',
            'pelayanan' => $pelayanan,
            'antrian' => $dataAntrian
        ];
        return view('admin/antrian_pelayanan/report', $data);
    }
    public function pdf()
    {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Ahmad Habibi');
        $pdf->SetTitle('Laporan PDF');
        $pdf->SetSubject('Laporan PDF');
        $pdf->SetKeywords('TCPDF, PDF');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        //view halaman yg akan dicetak
        $dataInput = $this->request->getVar();

        $awal = $dataInput['tgl_awal'];
        $akhir = $dataInput['tgl_akhir'];
        $pelayanan = $dataInput['pelayanan_id'];
        $dataAntrian = $this->antrian->reportAntrianByPelayanan($pelayanan, $awal, $akhir)->getResult();

        $data = [
            'heading' => 'Report Kinerja Pelayanan',
            'pelayanan' => $pelayanan,
            'antrian' => $dataAntrian,
            'periode' => date('M-Y', strtotime($awal)),
            'data' => $this->dokter->getDokterByPelayanan($pelayanan)->getResult()[0]
        ];
        $html = view('admin/antrian_pelayanan/report_pdf', $data);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('laporan_pelayanan.pdf', 'I');
    }
}
