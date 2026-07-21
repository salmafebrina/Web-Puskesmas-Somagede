import './bootstrap';
<script>

function panggilAntrian(kodeAntrian){

    const text = "Nomor antrian " + kodeAntrian + ", silakan menuju loket pendaftaran.";

    const suara = new SpeechSynthesisUtterance(text);

    suara.lang = "id-ID";

    suara.rate = 0.9;

    suara.pitch = 1;

    speechSynthesis.cancel();

    speechSynthesis.speak(suara);

}

</script>