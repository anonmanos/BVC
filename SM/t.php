
                                    //if($m>='1')
                                    {   
                                    $traned_date = date("Y-m-d");//วันที่ลงทะเบียน
                                    $sql= "insert into trained values('$regis_id','$mi','$traned_date','$t','$s')";
                                    mysql_query($sql) or die("error=$sql");
                                    echo "<script>alert(' ++ Complete ++ ');";
                                    $trained    =   1;
                                    echo "113";   
                                        }
                                    }