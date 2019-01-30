<?php
    /**
     * Class Pagination
     * Author: Antoine Vauthey
     */
    class Pagination{
        /**
         *
         * @var int 
         */
        protected $limit;
        /**
         *
         * @var int 
         */
        protected $nbElement;
        /**
         *
         * @var int 
         */
        protected $nbPage;
        /**
         *
         * @var array 
         */
        protected $data;
        /**
        *
        * @var string
        */
        protected $lienPage;
            
        /**
         * Données à exploitées
         * @param array $array
         * Limite par défaut 10
         */
        function __construct($array) {
            $this->nbElement = count($array);
            $this->data = $array;
            $this->limit = 10;
        }
        /**
         * Fixe la limite de lignes de tableau à afficher par page
         * @param int $limit
         */
        function setLimit($limit){
            $this->limit = $limit;
        }
        
        /**
         * 
         * @param string $string
         */
        function setLienPage($string){
            $this->lienPage = $string;
        }
        /**
         * Définit le nombre de page max
         */
        function setPage(){
            $nbElement = $this->nbElement;
            $nbElementParPage = $this->limit;
            $nbPage = 1;
            while($nbElement > $nbElementParPage){
                $nbPage++;
                $nbElement = $nbElement - $nbElementParPage;
            }
            $this->nbPage = $nbPage;
        }
        /**
         * Retourne un tableau avec les données à afficher pour la page courante
         * @param int $page 
         * @return array
         */
        function getArray($page){
            $tableau = array();
            $page = $page-1;
            $indexDebut = $this->limit * $page;
            $indexFin = $indexDebut + $this->limit;
            for($i=$indexDebut;$i<$indexFin;$i++){
                if(isset($this->data[$i])){
                    $tableau[] = $this->data[$i];
                }
            }
            return $tableau;
        }
        /**
         * Retourne le code de la pagination pour la page courante
         * @param int $page
         * @return string
         */
        function getBootstrapPaginationCode($page){
            $nbPage = $this->nbPage;
            $p = 1;
            if($page == 1){
                if($nbPage == 1){ // Dans le cas où il y a une et une seule page
                    $code = '<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="'.$this->lienPage.'&page=1">1</a></li>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Suivant</a>
                                    </li>
                                </ul>
                            </nav>'
                    ;
                }
                else{ // Cas où la page active est la 1 et il y a plusieurs page
                    $i = 2;
                    $tempArray = array();
                    while ($i <= $nbPage){
                        $tempArray[] = '<li class="page-item"><a class="page-link" href="'.$this->lienPage.'&page='.$i.'">'.$i.'</a></li>';
                        $i++;
                    }
                    $code = '<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="'.$this->lienPage.'&page=1">1</a></li>'.
                                    implode($tempArray)
                                    .'<li class="page-item">
                                        <a class="page-link" href="'.$this->lienPage.'&page=2">Suivant</a>
                                    </li>
                                </ul>
                            </nav>'
                    ;
                    unset($tempArray);
                }
            }
            else{
                if($page == $nbPage){ // Case où ce n'est pas la page 1 et que c'est la denière
                    $i = 2;
                    $tempArray = array();
                    while ($i <= $nbPage){
                        if($i == $page){
                            $tempArray[] = '<li class="page-item active"><a class="page-link" href="'.$this->lienPage.'&page='.$i.'">'.$i.'</a></li>';
                        }else{
                            $tempArray[] = '<li class="page-item"><a class="page-link" href="'.$this->lienPage.'&page='.$i.'">'.$i.'</a></li>';
                        }
                        $i++;
                    }
                    $p = $page - 1;
                    $code = '<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="'.$this->lienPage.'&page='.$p.'" >Précédent</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="'.$this->lienPage.'&page=1">1</a></li>'.
                                    implode($tempArray) 
                                    .'<li class="page-item disabled">
                                        <a class="page-link" href="#">Suivant</a>
                                    </li>
                                </ul>
                            </nav>'
                    ;
                    unset($tempArray);
                }
                else{ // Cas où ce n'est ni la première ni la dernière page
                    $i = 2;
                    $tempArray = array();
                    while ($i <= $nbPage){
                        if($i == $page){
                            $tempArray[] = '<li class="page-item active"><a class="page-link" href="'.$this->lienPage.'&page='.$i.'">'.$i.'</a></li>';
                        }else{
                            $tempArray[] = '<li class="page-item"><a class="page-link" href="'.$this->lienPage.'&page='.$i.'">'.$i.'</a></li>';
                        }
                        $i++;
                    }
                    $pp = $page - 1;
                    $pn = $page + 1;
                    $code = '<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="'.$this->lienPage.'&page='.$pp .'" >Précédent</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="'.$this->lienPage.'&page=1">1</a></li>'.
                                    implode($tempArray) 
                                    .'<li class="page-item">
                                        <a class="page-link" href="'.$this->lienPage.'&page='.$pn .'">Suivant</a>
                                    </li>
                                </ul>
                            </nav>'
                    ;
                    unset($tempArray);
                }
            }
            return $code;
        }
    }

