
<?php
if(isset($_POST["query"]))
{
    include('connection.php');
    $request=$_POST["query"];
    $sql=mysqli_query($conn,"select Serial_no,ngo_requirements.ngo_id,req,req_descr,NGO_name,Email,Phone,address,Area from  ngo_requirements inner join registration on ngo_requirements.ngo_id=registration.ngo_id where registration.NGO_name like '%".$request."%' or registration.Area like '%".$request."%' or ngo_requirements.req like '%".$request."%'");
    $count=mysqli_num_rows($sql);
    $html='';
    $data=array();
    $html.='<table class="table table-bordered table-striped">
    <tr>
    <th>Serial No.</th>
    <th>NGO ID</th>
    <th>NGO name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Area</th>
    <th>Requirements</th>
    <th>Requirements Description</th>
    
    <th>Be a helping hand</th>
    </tr>';

    while($row=mysqli_fetch_array($sql))
    {
        $data=$row["ngo_id"];
        $data=$row["Serial_no"];
        $data=$row["NGO_name"];
        $data=$row["Email"];
        $data=$row["Phone"];
        $data=$row["address"];
        $data=$row["Area"];
        $data=$row["req"];
        $data=$row["req_descr"];
        $html.='
        <tr>
        <td>'.$row["ngo_id"].'</td>
        <td>'.$row["Serial_no"].'</td>
        <td>'.$row["NGO_name"].'</td>
        <td>'.$row["Email"].'</td>
        <td>'.$row["Phone"].'</td>
        <td>'.$row["address"].'</td>
        <td>'.$row["Area"].'</td>
        <td>'.$row["req"].'</td>
        <td>'.$row["req_descr"].'</td>

        <td><button class="btn btn-primary btn-modal" name="donate" onclick="modalname()" >Donate</button></td>
        
        </tr>
        ';
    }
    $html.='</table>';
    if(isset($_POST['typehead_search']))
    {
     echo $html;   
    }
    else
    {
        $data=array_unique($data);
        echo json_encode($data);
    }
}
else
{
    echo $data;
}
?>

