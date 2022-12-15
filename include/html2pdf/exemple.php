<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
   
    ob_start();
    ?>
    <style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-bottom: solid 1mm #58585A; }
    table.page_footer {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-top: solid 1mm #58585A; }
-->
</style>
<page backtop="30mm" backbottom="15mm" backleft="5mm" backright="5mm">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 50%; text-align: left; ">
                    <img src="logo.jpg" height="50" />
                </td> 
                <td style="width: 50%; text-align: right; ">
                    <h1></h1>
                </td>                
            </tr>            
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>    
                <td style="width: 100%; text-align: center">
                    &copy; Paragon Acce. All Rights Reserved
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellpadding="0" cellspacing="0" border="0" >
        <tr><td width="100%;" >&nbsp;</td></tr>
        <tr>
            <td width="100%;" >
                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 
                <tr>
                    <td width="50%;" >
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" width="100%;" >
                            <tr><td width="100%" ><strong>Paragon Acc Pvt. Ltd.</strong> </td></tr>
                            <tr><td width="100%" ><strong>Address:</strong> Shapar </td></tr>
                            <tr><td width="100%" ><strong>Postal Code:</strong> 395010</td></tr>
                            <tr><td width="100%" ><strong>Contact:</strong> 9090909090</td></tr>
                            <tr><td width="100%" >&nbsp;</td></tr>
                        </table>
                    </td>
                    <td width="50%;" >
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" align="right" >
                            <tr><td width="100%" ><strong>Invoice No:</strong> #1234</td></tr>
                            <tr><td width="100%" ><strong>Created Date:</strong> 1/1/1111</td></tr>
                            <tr><td width="100%" ><strong>Due:</strong> 1/1/1111</td></tr>
                            <tr><td width="100%" ><strong>Created By:</strong>Tushar </td></tr>
                        </table>
                    </td>
               </tr>
               </table>     
            </td>
        </tr>
        <tr><td width="100%;" >&nbsp;</td></tr>
        <tr>
            <td width="100%;" >
                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 
                <tr>
                    <td width="100%;" >
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:30px;" width="100%;" >
                            <tr><td width="100%" ><strong>Bill To:</strong> Jaspal </td></tr>
                            <tr><td width="100%" ><strong>Contact No.:</strong> 90909090</td></tr>
                            <tr><td width="100%" ><strong>Email:</strong> asdasd@gmailc.om</td></tr>
                        </table>
                    </td>                    
               </tr>
               </table>     
            </td>
        </tr>
        <tr><td width="100%;" >&nbsp;</td></tr>
        <tr>
            <td width="100%;" >
                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 
                <tr>
                    <td width="100%;" >
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" >
                            <tr>
                                <td width="80%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Description</strong></td>
                                <td width="20%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Amount</strong></td>
                            </tr>

                            <tr>
                                <td width="80%;" style="color:#000; padding:8px; width:150px; background:#FFF; border-left:1px solid #58585A; border-right:1px solid #58585A;" align="left" >Pump</td>
                                <td width="20%;" style="color:#000; padding:8px; width:150px; background:#FFF; border-left:1px solid #58585A; border-right:1px solid #58585A;" align="center" >Rs. 200</td>
                            </tr>
                            <tr>
                                <td width="80%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Total</strong></td>
                                <td width="20%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Rs. 500</strong></td>
                            </tr>
                        </table>
                    </td>                    
               </tr>
               </table>     
            </td>
        </tr>
        <tr><td width="100%;" >&nbsp;</td></tr>
        <tr>
            <td width="100%;" >
                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 
                <tr>
                    <td width="100%;" >
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:30px;" width="100%;" >
                            <tr><td width="100%" ><strong>Payment Information:</strong> -</td></tr>
                            <tr><td width="100%" >Cheque</td></tr>                            
                        </table>
                    </td>                    
               </tr>
               </table>     
            </td>
        </tr>
        <tr><td width="100%;" >&nbsp;</td></tr>
    </table>
</page>
    <?php
    $content = ob_get_clean();
    // convert to PDF
    include('html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        //$html2pdf->setTestTdInOnePage(false);
        $html2pdf->writeHTML($content);
        $html2pdf->Output('exemple.pdf', 'F');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
