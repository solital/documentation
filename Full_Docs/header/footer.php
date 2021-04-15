</main>

<footer class="bg-5 mt-5">
    <section class="container mb-3">
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-5">
                <h4 class="font-weight-bold">Follow</h4>
                <ul class="mt-3 ml-3">
                    <li><a href="https://www.instagram.com/solitalframework/" class="txt-8">Instagram</a></li>
                </ul>
            </div>

            <div class="col-md-6 col-sm-12 mt-5">
                <ul class="mt-3 ml-3">
                    <li><a href="<?= fullUrl() ?>/contribute" class="txt-8">Contribute</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="text-center p-4" style="background-color: #1C1C1C;">
        <span>&copy; Copyright. <?= date('Y') ?></span>
    </section>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="<?= fullUrl() ?>/assets/js/wow.js"></script>
<script>
    // JAVASCRIPT
    $(document).ready(function() {
        $('#subir').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        });
    });
</script>
</body>

</html>