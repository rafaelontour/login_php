
<header>
    <h1>Sistema - Cabeçalho</h1>
    <p>
        Já tem uma conta?
        <a href="#">Login</a>
    </p>
</header>

<style>
    header, footer {
        display: flex;
        flex-flow: column wrap;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100px;
        background-color: aqua;
    }
    
    header > p {
        position: absolute;
        right: 40px;
    }
    
    header > p > a {
        background-color: blue;
        padding: 15px 50px;
        margin: 25px;
        border-radius: 29px;
        color: white;
        text-decoration: none;
        font-size: 20px;
        text-transform: uppercase;
    }

</style>

