<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contact.index');
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $id = 0;
        $rules = [
            'address'=> 'required',
            'name' => 'required|unique:contacts,name,' . $id,
            'phone' => 'required|unique:contacts,phone,' . $id,
            'email' => 'required|email|unique:contacts,email,' . $id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $input = [
                "name"=> $request->get("name"),
                "email"=> $request->get("email"),
                "phone"=> $request->get("phone"),
                "website"=> $request->get("website"),
                "address"=> $request->get("address")
            ];

            $model = Contact::create($input);
            return redirect()->route("contact.show", ["id"=> $model->id])->with("success", "Data berhasil ditambahkan !!");
        }

    }

    public function show($id)
    {
        $model = Contact::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('contact.show')->with('model', $model);
    }   

    public function edit($id)
    {
        $model = Contact::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('contact.edit')->with('model', $model);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'address'=> 'required',
            'name' => 'required|unique:contacts,name,' . $id,
            'phone' => 'required|unique:contacts,phone,' . $id,
            'email' => 'required|email|unique:contacts,email,' . $id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $input = [
                "name"=> $request->get("name"),
                "email"=> $request->get("email"),
                "phone"=> $request->get("phone"),
                "website"=> $request->get("website"),
                "address"=> $request->get("address")
            ];

            Contact::where("id", $id)->update($input);
            return redirect()->route("contact.show", ["id"=> $id])->with("success", "Data berhasil diperbaharui !!");
        }
    }

    public function destroy($id)
    {
        Contact::where("id", $id)->delete();
        return response()->json(["ok"]);
    }

    public function downloadPdf()
    {
        $files = public_path("files");

        if(!is_dir($files))
        {
            @mkdir($files);
        }
     
        $contacts = Contact::where("id", "<>", 0)->orderBy("id")->get();
        $filename = 'kontak_person_'.time().'.pdf';
    	$data = ['contacts' => $contacts];
    	$view = View::make('contact.pdf', $data);
        $html = $view->render();
    	$pdf = new TCPDF;
        $pdf::SetTitle('Kontak Person');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output(public_path("files/".$filename), 'F');
        return response()->download(public_path("files/".$filename));
    }

    public function downloadExcel()
    {
      
        $data = Contact::where("id", "<>", 0)->orderBy("id")->get();
        return Excel::create("kontak_person_".time(), function ($excel) use ($data) {
            $excel->sheet('Sheet1', function ($sheet) use ($data) {

                $sheet->cell('A1', function ($cell)  {
                    $cell->setValue("Kontak Person");
                });
                $sheet->cell('A3', function ($cell) {
                    $cell->setValue('No.');
                });
                $sheet->cell('B3', function ($cell) {
                    $cell->setValue('Nama');
                });
                $sheet->cell('C3', function ($cell) {
                    $cell->setValue('Email');
                });
                $sheet->cell('D3', function ($cell) {
                    $cell->setValue('Telepon');
                });
                $sheet->cell('E3', function ($cell) {
                    $cell->setValue('Website');
                });
                $sheet->cell('F3', function ($cell) {
                    $cell->setValue('Alamat');
                });
                $sheet->mergeCells('A1:F1');
                $last = "F";
                
                $sheet->getStyle('A1:'.$last.'1')->applyFromArray(array(
                    'font' => array(
                        'bold' => true,
                        'size' => 14,
                    ),
                    'alignment' => array(
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                ))->getAlignment()->setWrapText(true);
                $sheet->getStyle('A2:'.$last.'2')->applyFromArray(array(
                    'font' => array(
                        'bold' => true,
                        'size' => 14,
                    ),
                    'alignment' => array(
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                ))->getAlignment()->setWrapText(true);

                $sheet->cells('A3:'.$last.'3', function ($cells) {
                    $cells->setBackground('#DCDCDC');
                    // $cells->setAlignment('center');
                });
                $sheet->setAutoSize(true);
                $sheet->setFontFamily('Arial');
                $sheet->getStyle('A3:'.$last.'3')->applyFromArray(array(
                    'font' => array(
                        'bold' => true,
                    ),
                    'alignment' => array(
                        'vertical' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    ),
                ))->getAlignment()->setWrapText(true);

                $start = 4;

                foreach ($data as $index => $row) {

                    $sheet->cell('A' . $start, function ($cell) use ($index) {
                        $cell->setValue($index + 1);
                    });
                    $sheet->cell('B' . $start, function ($cell) use ($row) {
                        $cell->setValue($row->name);
                    });
                    $sheet->cell('C' . $start, function ($cell) use ($row) {
                        $cell->setValue($row->email);
                    });
                    $sheet->cell('D' . $start, function ($cell) use ($row) {
                        $cell->setValue($row->phone);
                    });
                    $sheet->cell('E' . $start, function ($cell) use ($row) {
                        $cell->setValue($row->website);
                    });
                    $sheet->cell('F' . $start, function ($cell) use ($row) {
                        $cell->setValue($row->address);
                    });
                    $start++;
                }

                $start = $start - 1;
                $thin = array();
                $thin['borders'] = array();
                $thin['borders']['allborders'] = array();
                $thin['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
                $sheet->getStyle('A3:'.$last.'' . $start)->applyFromArray($thin)->getAlignment()->setWrapText(true);

            });
        })->download("xlsx");
    }

}
