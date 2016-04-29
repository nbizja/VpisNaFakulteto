<?php namespace App\Helpers;


class ExportHelper {
    public function __construct(){
    }
    public static function make_csv(array $data, $title='Naslov', $description='') {
        $file = Excel::create($title, function($excel) use($data, $title, $description) {
            $excel->setTitle($title);
            $excel->setDescription($description);
            $excel->sheet($title, function($sheet) use($data) {
                $sheet->fromArray(self::convert($data),null, 'A0',true);
            });
        });
        $file->export('csv');
        return true;
    }

    public static function make_pdf(array $content, $title='Naslov', $description='') {
        $converted = self::convert($content);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pdf/tableTemplate', ['content'=>$converted, 'title'=>$title, 'description'=>$description]);
        return $pdf->download($title.'.pdf');
    }

    private static function recode($string){
        $map = ['č'=>'c','Č'=>'C','š'=>'s','Š'=>'S','ž'=>'z','Ž'=>'Z'];
        foreach($map as $bad => $good){
            $string = str_replace($bad,$good,$string);
        }
        return $string;
    }

    public static function convert(array $data){
        $new_data =[];
        foreach($data as $row){
            $new_row = [];
            foreach($row as $col){
                $new_row[] = self::recode($col);
            }
            $new_data[] = $new_row;
        }
        return $new_data;
    }
}