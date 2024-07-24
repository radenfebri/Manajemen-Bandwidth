Traffic Upload (TX) = <b style="color: blue">{{ formatBytes($tx, 2) }}</b><br>
Traffic Download (RX) = <b style="color: red">{{ formatBytes($rx, 2) }}</b><br>

@php function formatBytes($bytes, $decimal = null){
    $satuan = ['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
    $i = 0;
    while ($bytes > 1024) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, $decimal) .'-' . $satuan[$i];
}
@endphp