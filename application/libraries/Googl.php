<?php
class Googl
{
    
    // Declara as propriedades que serão utilizadas
    public $url_original,
           $url_curta,
           $erro,
           $erro_msg = NULL;
    
    // Este será nosso objeto cURL, o que utilizaremos para acessar a API
    private $curl;
    
    // Nosso método construtor, que será executado quando a classe for instanciada
    public function __construct()
    {
        // Cria nosso objeto cURL
        $this->curl = curl_init();
        
        // Configura o objeto para retornar os dados ao invés de imprimir na tela
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        /* Configura o objeto para responder a redirecionamentos
           É utilizado no método de desencurtar URLs, pois precisamos seguir até a URL final */
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
    }
    
    // Método para encurtar a URL
    public function encurtar($url)
    {
        // Utilizamos esta função para codificar os caracteres especiais da URL
        $urlCodificada = rawurlencode($url);
        
        // Esta é a URL que utilizaremos para acessar a API
        $urlApi = 'http://is.gd/api.php?longurl='.$urlCodificada;
        
        // Configuramos a URL no cURL
        curl_setopt($this->curl, CURLOPT_URL, $urlApi);
        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT , 5);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_ENCODING, "");
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
        curl_setopt($this->curl, CURLOPT_MAXREDIRS, 15);   
        
        // Executamos a requisição
        $retorno = curl_exec($this->curl);
        
        // Recebemos os dados da execução
        $dados = curl_getinfo($this->curl);
        // O http_code pode ser 200 (OK) e 500 (Internal Server Error)
        /* Junto com a verificação, é bom olhar também se a URL
           possui menos de 20 caracteres, já que o is.gd trabalha
           com no máximo 18. Isto ajuda a evitar error arbitrários. */
        if ($dados['http_code'] == 200 && $retorno) {
            // Caso tenha ocorrido tudo bem, resetamos estas propriedades
            $this->erro = false;
            $this->erro_msg = NULL;
            $this->url_curta = $retorno;
        } else {
            // Caso tenha dado algum problema, colocamos os dados aqui
            $this->erro = true;
            $this->erro_msg = $retorno;
            $this->url_curta = NULL;
        }
        
        // Colocamos a URL original no seu lugar
        $this->url_original = $url;
        
        /* Por fim, para tornar mais fácil ainda, o retorno da função será
           true ou false dependendo do resultado que obtivemos no processo */
        return $this->erro;
    }
    
    // Método para desencurtar a URL
    public function desencurtar($url)
    {
        // Primeiro verificamos se a URL é realmente is.gd
        if (substr($url, 0, 13) == 'http://is.gd/' || substr($url, 0, 6) == 'is.gd/') {
            // Configuramos a URL no cURL
            curl_setopt($this->curl, CURLOPT_URL, $url);
            
            // Executamos a requisição
            curl_exec($this->curl);
            
            // Recebemos os dados da execução
            $dados = curl_getinfo($this->curl);
            
            // Testamos se o status é 200 e se a URL retornada é diferente da desencurtada
            if ($dados['http_code'] == 200 && $url != $dados['url']) {
                // Retornamos a URL desencurtada
                return $dados['url'];
            }
        }
        // Caso tenha dado algum problema no meio do caminho, retornamos false
        return false;
    }
}