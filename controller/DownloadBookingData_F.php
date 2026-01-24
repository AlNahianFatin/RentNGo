<?php
require_once('../model/rentModel.php');
require_once('../lib/tcpdf/tcpdf.php'); // or fpdf

$customer = $_GET['customer'] ?? '';
if ($customer === '') {
    $records = getAllRentRecords();
} else {
    $records = searchRentRecordByCName($customer);
}

// Create PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$html = '<h2>Rental Records</h2><table border="1" cellpadding="4"><tr>
    <th>Customer Name</th><th>Booking Date</th><th>Pickup Location</th><th>Dropoff Location</th>
    <th>Hours Rented</th><th>Car Rent</th><th>Fuel Cost</th><th>Total Rent</th>
    <th>Applied Loyalty</th><th>Final Rent</th><th>Payment Status</th></tr>';

foreach ($records as $record) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($record['cname']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['bdate']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['plocation']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['dlocation']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['renthours']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['crent']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['fcost']) . '</td>';
    $html .= '<td>' . htmlspecialchars($record['trent']) . '</td>';
    $html .= '<td>' . ($record['loyalty'] != "" ? htmlspecialchars($record['loyalty']) : "---") . '</td>';
    $html .= '<td>' . htmlspecialchars($record['frent']) . '</td>';
    $html .= '<td>' . (htmlspecialchars($record['pstatus']) ? "Paid" : "Pending") . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('rental_records.pdf', 'D');
exit;
?>