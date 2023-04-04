<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/geral.css">
    <link rel="stylesheet" href="/css/certificado.css">
</head>

<body>
    <section class="sec_certificado">
        <img src="https://lh3.googleusercontent.com/OxLqgIpWo8EaZn7C-SynB71ZCtUllETJCQHjEmXAMK0iqOGekE3iud6Z1TMZg6hMKogM9BWNnE5ukifT85m0g8Usd-kGFxdA4ITtOiTj325VPi7yxM6oDbehPV9YtAWFBIW96mIF4OrWRaro5ksn9IMu5M-7Ybi6vVYV2PwLcoj1q_Jyk8kX4YcUg45bY5SjUu93P1NkHUq2Lbd6eHvIPLGBdiuk7buago3ZbxKsc-qJhwVg0RqP-rdcxkonVzkmCwAtoadfhOF_vK4n--tQnoS7TsGYML1dwxaPto078mh5VRkVD7yv3t5fHc_eNxLsKyKNOP_NfkrpOF3j2w57EtzRLIti37S7RvTQFFXQ377uirisMNkPvsTwD8Xo2gf7M18gfdUHWsixNk4qo6FnyvJlmAYp78bOOTrIsz2HZlPKkSX4qnEV-lp5BGeM4hc7ZR2VF0iMvTbAKiHGUWZwSAlYT-Tcd2EShxGMbV8gyadgXzS2LFCDKk5uGFz8JJh8mJQJohchnMn4rp-G3bKwIJBManGsE5IJL6AVkzX3ivMqqh66Ti_KUwLFZkrKqNKqWODHSeWzafS3GzjW_xdrPEp18cYvRjPhU2vn458oKCS5WyyH4-PUuKrj13tU86d6DpxrCmsR2qyICl2nZIAPdELSGKUNzYeJXFMmL_DlmSih1FzJA8jf4zlJnKCWLXmPlRRQ739Vwcb9N3hTlP95W_4j5Rkoz0T7vEcVP8dK9ZMpFIDC36i54kz-qYsENXGp1rKIWL3Q29cmeyvlhl1G17vC9RK7y-Qku_7MgotKQ2px80Qp4zJ6W7YerBf2Tl2i6knisEVAtec6SQE7YXwx-Z-mDHWrRAhX_5weLbPQZqFLEgjYdemZg4DHQU-wsIpUfiGX7ofwJIFgPVraLDu4Jk_C4cRwd4laILl_IRBc_3yJo8WVcy3ktF9asDOjDd7_XEWcFa5WSd6DUND0eJQ"
            alt="" class="img_certificado">

        <div class="content_certificado">
            <div id="header_certificado">
                <div id="logo_div">
                    <img src="https://lh3.googleusercontent.com/Do4YWzwlk61PqRSKr_duNOUn-ivFAE8ErrcdrXCx5_8leA0LkDwz7cjxnlXEIwez-pgP12aJMXqzeEKJzrNZw5vxi9MvM2hlBPpj3aOsqXtdVKDeclE6ybzM2P8HYMkLULS7UrwH_u9t_8hkZzCzXIf6NEHaV2V0zKc_tNDO9FKpd264EtEA9021GcmK3vlJKvmCDlm8sCzaLvFG6JAGBF_WqMjHOVHePy7AByiLfyUZG40lJVwu55gNWqg0gxdzsuvGbUq7a0OnNO11SDIPwy4JqYRlAQLFMAjdxFIIUTB1fLrd_NQUb9uhEKcoUu6vE2ITVYFpD6riiPGjEJWV8v9xubEIUuxJ6h_iNMm8GD0mXJqBzQd76iT5oc6elJSfQ1qlLTWreHcdCghbfuaXD0iS2X3x2lBxYRIXC8DW5mPtupvn-yA2nEyq3MSSMWvdwFko1gLbexfmo-DbNyxr1iYPGHL0Rje5WfkEK28_nB9OqcbQZeKnPt5WVTEzedCZi1yt0urawbLqqh4RHNoeQRoRDkrKu9ZHKuMD0Kb3zMivLHphpRaz_RH6-GghJtEmsmasIariA_-pjEhzlnR-_-Wq9C3-ptKx8caoJTmJwzeokQ5hbrgNtBB5pc2RXmow5dvhnU4v3PdDU2-4ZQKEXf295WLnh36cof_20zbMCcj2HdIJ3yIU1dc2UdECOccNMfJ8xG-tl0TW1gxbD_yy3ENbrcW3mn3XfYIZSWcWojJ155z0GdHzLhj81LoVylElW9gFo_Xqwsbtmz-LYGUge1WNGW8JtSKvBjU4rjOUSBfLoJEoribVi2P1IXpLjImDhbrupe327cRmuEFEVhMAz92FX-BFR5TNVOsuEmZ1yr9u1j1moWG5_e6Vyu7uWwEVvabI0-t1UdfQlnPjAk3XNf3Am4nZKH7RVHJ5E-__jbwxuO9beoTfC3mUygQIR_-ZGmcW4cmE_coHAx3MtNs=w500-h380-s-no?authuser=0"
                        alt="logo do site cursos play">
                    <span id="logotipo">Cursos Play</span>
                </div>
                <div style="text-align: center; font-size: 10pt;"> Plataforma de Curso Online </div>
            </div>
            <div class="content">
                <h1 id="title"> Certificado de Conclusão </h1>
                <p class="text">Certificamos que {{ Auth::user()->name }}, concluiu no dia
                    {{ date_format($matricula->updated_at, 'd/m/Y') }} o curso online: <span
                        class="destaque">{{ $curso->name }}</span> </p>
            </div>

            <div id="footer">
                <ul id="content_prog">
                    <h2 style="font-size: 12pt;"> Conteúdo programático </h2>
                    @foreach ($curso->conteudos as $key => $c)
                        @if ($key < 4)
                            <li id="caps" style="font-size: 10pt;"> Capitulo {{ $key + 1 }}:
                                {{ $c->name }}
                            </li>
                        @endif
                    @endforeach
                </ul>

                <div id="alert_end">
                    Esses certificados não possuem nenhum peso educacional, só servem de ilustração para o site teste
                    "Cursos Play".
                </div>
            </div>
        </div>
    </section>

    <div class="position-fixed bg-primary start-0 botton-0 m-5">
        <a href="/">Voltar</a>
    </div>
</body>

<script>
    const logotipo = document.getElementById('logotipo');
    const textLogo = logotipo.textContent;
    if (typeof logotipo != undefined) {
        const text = textLogo.split(" ");
        console.log(text);
    }
</script>

</html>
