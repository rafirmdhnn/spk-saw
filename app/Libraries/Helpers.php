<?php 
namespace App\Libraries;
use DB;
Class Helpers {
    public static function SAW_get_rel(){
        $rows = DB::select("SELECT a.id as kode_alternatif, k.id as kode_kriteria, c.id as kriteria_nilai_id
        FROM alternatifs a 
            INNER JOIN alternatif_nilais ra ON ra.alternatif_id  = a.id
            INNER JOIN kriterias k ON k.id=ra.kriteria_id 
            LEFT JOIN kriteria_nilais c ON c.id=ra.nilai_kriteria_id 
        ORDER BY a.id, k.id");

        // SELECT a.kode_alternatif, k.kode_kriteria, c.kode_crips
        //     FROM tb_alternatif a 
        //         INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
        //         INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
        //         LEFT JOIN tb_nilai_kriteria c ON c.kode_crips=ra.kode_crips
        //     ORDER BY a.kode_alternatif, k.kode_kriteria
        $data = array();
        foreach($rows as $row){
            $data[$row->kode_alternatif][$row->kode_kriteria] = $row->kriteria_nilai_id;
        }
        return $data;
    }

    public static function unrupiah($angka = null) {
        $angka = str_replace(',', '', $angka);
        $angka_explode = $angka;
        return $angka_explode;
    }

    public static function unukuran($angka = null) {
        $angka = str_replace('.', '', $angka);
        $angka_explode = $angka;
        return $angka_explode;
    }
    

    public static function max_with_key($array, $key) {
        if (!is_array($array) || count($array) == 0) return false;
        $max = $array[0][$key];
        foreach($array as $a) {
            if($a[$key] > $max) {
                $max = $a[$key];
            }
        }
        return $max;
    }

    public static function min_with_key($array, $key) {
        if (!is_array($array) || count($array) == 0) return false;
        $min = $array[0][$key];
        foreach($array as $a) {
            if($a[$key] < $min) {
                $min = $a[$key];
            }
        }
        return $min;
    }


    public static function get_crips_option($kriteria, $selected = 0) {
        
        $rows = DB::table('kriteria_nilais')->select('id','kn_keterangan','kn_nilai')->where('kriteria_id', $kriteria)->get();
        $a = '';   
        foreach($rows as $row){
            if($row->id==$selected)
                $a.= '<option value='.$row->id.' selected>$row->kn_keterangan</option>';
            else
                $a.= '<option value='.$row->id.'>$row->kn_keterangan</option>';
        }

        return $a;
    }

    public static function http_request($url){
        // persiapkan curl
        $ch = curl_init(); 
    
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    
        // $output contains the output string 
        $output = curl_exec($ch); 
    
        // tutup curl 
        curl_close($ch);      
    
        // mengembalikan hasil curl
        return $output;
    }

}