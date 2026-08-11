
<div class="modal fade"
     id="wizardPlanModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h4 class="mb-1">
                        Tindak Lanjut Pasien
                    </h4>

                    <small class="text-muted">
                        Lengkapi formulir tindak lanjut pasien
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                {{-- Progress --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <span id="wizardTitle">
                            Resep Obat
                        </span>

                        <span id="wizardStep">
                            1 / 3
                        </span>

                    </div>

                    <div class="progress mt-2" style="height:8px">

                        <div
                            id="wizardProgress"
                            class="progress-bar"
                            style="width:33%">
                        </div>

                    </div>

                </div>


                {{-- Tempat isi form --}}
                <div id="wizardContent">

            
    <div id="step-resep">

        @include('pemeriksaan.plan.resep', ['obats' => $obats])

    </div>

    <div id="step-lab" class="d-none">

        @include('pemeriksaan.plan.laboratorium')

    </div>

    <div id="step-rujukan" class="d-none">

        @include('pemeriksaan.plan.rujukan')

    </div>

</div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    id="btnBack">

                    Kembali

                </button>

                <button
                    class="btn btn-primary"
                    id="btnNext">

                    Selanjutnya

                </button>

            </div>

@if(session('showWizard'))


@endif
<script>
document.addEventListener("DOMContentLoaded", function () {

    let current = 0;
    let steps = [];

    const modal = new bootstrap.Modal(
        document.getElementById("wizardPlanModal")
    );
    const modalElement = document.getElementById("wizardPlanModal");

modalElement.addEventListener("hidden.bs.modal", function () {

    document.body.classList.remove("modal-open");
    document.body.style.removeProperty("overflow");
    document.body.style.removeProperty("padding-right");

    document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());

});

    const btnBack = document.getElementById("btnBack");
    const btnNext = document.getElementById("btnNext");

    const title = document.getElementById("wizardTitle");
    const step = document.getElementById("wizardStep");
    const progress = document.getElementById("wizardProgress");

    function hideAllSteps() {
        document.getElementById("step-resep").classList.add("d-none");
        document.getElementById("step-lab").classList.add("d-none");
        document.getElementById("step-rujukan").classList.add("d-none");
    }

    function renderWizard() {

        hideAllSteps();

        document
            .getElementById(steps[current].id)
            .classList.remove("d-none");

        title.innerHTML = steps[current].title;

        step.innerHTML = (current + 1) + " / " + steps.length;

        progress.style.width =
            ((current + 1) / steps.length * 100) + "%";

        btnBack.style.display =
            current === 0 ? "none" : "inline-block";

        btnNext.innerHTML =
            current === steps.length - 1
                ? "Simpan & Selesai"
                : "Selanjutnya";
    }

    btnBack.addEventListener("click", function () {

        if(current > 0){

            current--;

            renderWizard();

        }

    });

    btnNext.addEventListener("click", function () {

        if(current < steps.length - 1){

            current++;

            renderWizard();

            }else{

    modal.hide();

    document.getElementById("formPemeriksaan").submit();

    }

    });

    document.getElementById("btnOpenWizard")
        .addEventListener("click", function(){

        steps = [];

        if(document.querySelector('input[name="plan[]"][value="Resep"]').checked){

            steps.push({
                id : "step-resep",
                title : "💊 Resep Obat"
            });

        }

        if(document.querySelector('input[name="plan[]"][value="Laboratorium"]').checked){

            steps.push({
                id : "step-lab",
                title : "🧪 Laboratorium"
            });

        }

        if(document.querySelector('input[name="plan[]"][value="Rujukan"]').checked){

            steps.push({
                id : "step-rujukan",
                title : "🏥 Surat Rujukan"
            });

        }

        if(steps.length === 0){

            alert("Pilih minimal satu Plan.");

            return;

        }

        current = 0;

        renderWizard();

        modal.show();

    });

});
</script>

        </div>

    </div>

</div>