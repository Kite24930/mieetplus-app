<html lang="ja">
<body>
<style>
    * {
        color: #586C61;
    }
    body {
        background: linear-gradient(291deg, #F4EBFF -3.27%, #E5FAF3 32.46%, #E9FFF7 47.83%, #EBFBF5 98.89%);
        padding: 20px;
    }
    main {
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: start;
        background-color: white;
        border-radius: 1rem;
        padding: 1rem;
    }
</style>
<main>
    @switch($data->types)
        @case('corporation')
            <h1>{{ $data->corporate_name.' '.$data->corporate_parson.'様' }}</h1>
            @break
        @case('individual')
            <h1>{{ $data->individual_name.'様' }}</h1>
            @break
    @endswitch
    <h2>この度はお問い合わせいただきありがとうございます。</h2>
    <p>以下の内容でお問い合わせを受け付けました。</p>
    <p>内容を確認の上、担当者よりご連絡をさせていただきます。</p>
    <hr>
    @switch($data->types)
        @case('corporation')
            <p>【企業名】{{ $data->corporate_name }}</p>
            <hr>
            <p>【企業HP】{{ $data->corporate_hp }}</p>
            <hr>
            <p>【担当者名】{{ $data->corporate_parson }}</p>
            <hr>
            <p>【担当者名ふりがな】{{ $data->corporate_ruby }}</p>
            @break
        @case('individual')
            <p>【氏名】{{ $data->individual_name }}</p>
            <hr>
            <p>【氏名ふりがな】{{ $data->individual_ruby }}</p>
            @break
    @endswitch
    <hr>
    <p>【住所(市町村まで)】{{ $data->address }}</p>
    <hr>
    <p>【電話番号】{{ $data->tel }}</p>
    <hr>
    <p>【メールアドレス】{{ $data->email }}</p>
    <hr>
    <p>【お問い合わせ内容】{{ $data->contents }}</p>
</main>
<footer>
    <p>株式会社プロジェクトM</p>
    <p>〒514-8507</p>
    <p>三重県津市栗真町屋町1577 三重大学 インキュベーション室 219号室</p>
    <p>TEL: 052-898-2697</p>
    <p>MAIL: info@mieet-plus.com</p>
    <p>会社HP: https://www.mie-projectm.com</p>
    <p>Mieet Plus: https://www.mieet-plus.com</p>
</footer>
</body>
</html>
