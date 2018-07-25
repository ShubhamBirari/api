<?php
    if(isset($_POST["student_id"]))
    {
        $output ='';
        $connect=mysqli_connect("localhost","root","","testing");
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://localhost/api/students/read",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true); //because of true, it's in an array

        //$query="SELECT * FROM tbl_employee WHERE id='".$_POST["student_id"]."'" ;
        //$result=mysqli_query($connect,$query);
        $output .='
        <div class="table-responsive">.
        <table class="table table-bordered">';

        foreach($response as $value)
        {
            foreach ($value as $row) 
            {
                if ($row['id']==$_POST["student_id"]) 
                {
                   $output .= '
                    <tr>
                        <td width="30%"><label>Name</label></td>
                        <td width="70%">'.$row["name"].'</td>
                    </tr>
                    <tr>
                        <td width="30%"><label>Corses</label></td>
                        <td width="70%">'.$row["course"].'</td>
                    </tr>
                    
                    ';
                }
            }
        }
        $output .="</table></div>";
        echo $output;
    }
    
    if(isset($_POST["delete_data"]))
    {
        $output ='';
        $connect=mysqli_connect("localhost","root","","testing");
        $query="DELETE FROM tbl_employee WHERE id='".$_POST["delete_data"]."'" ;
        $result=mysqli_query($connect,$query);
        
         $output .='
                    <div class="table-responsive">.
                    <table class="table table-bordered">';
        
        $output .="</table></div>";
        echo $output;
        
    } 
    
?>