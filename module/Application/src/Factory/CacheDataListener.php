<?php
namespace Application\Factory; 

class CacheDataListener  {
 
    protected $listeners = array();
    protected $cacheService;

    /**
     * CacheDataListener constructor.
     * @param \Zend\Cache\Storage\Adapter\Filesystem $cacheService
     */
    public function __construct(\Zend\Cache\Storage\Adapter\Filesystem $cacheService) {
        // We store the cache service generated by Zend\Cache from the service manager
        $this->cacheService = $cacheService;
    }

    /**
     * @return \Zend\Cache\Storage\Adapter\Filesystem
     */
    public function getCacheService(){
        return $this->cacheService;
    }

    /**
     * @param $routeMatch
     * @return bool|mixed
     */
    public function getCacheDataItem($routeMatch) {
        
        $cacheKey ='';
        
        if($routeMatch instanceof \Zend\Router\RouteMatch){
            $cacheKey = $this->generateCacheDataKey($routeMatch);
        }
        else{
            $cacheKey = $routeMatch;
        }
        
        // get the data in cache for this route
        $data = $this->cacheService->getItem($cacheKey);
         
        // data can not be empty
        if (!empty($data)) {
            return $data;    
        }
        else{
            return false;
        }
        
    }

    /**
     * @param $routeMatch
     * @param array $data
     * @return bool
     */
    public function setCacheDataItem($routeMatch, array $data) {
        
        $cacheKey ='';
        
        if($routeMatch instanceof \Zend\Router\RouteMatch){
            $cacheKey = $this->generateCacheDataKey($routeMatch);
        }
        else{
            $cacheKey = $routeMatch;
        }
        
        return $this->cacheService->setItem($cacheKey, $data);
        
    }

    /**
     * @param $routeMatch
     * @return bool
     */
    public function removeCacheDataItem($routeMatch){
        
        $cacheKey ='';
        
        if($routeMatch instanceof \Zend\Router\RouteMatch){
            $cacheKey = $this->generateCacheDataKey($routeMatch);
        }
        else{
            $cacheKey = $routeMatch;
        }
        
        return $this->cacheService->removeItem($cacheKey);
    }

    /**
     * @param $route
     * @return string
     */
    protected function generateCacheDataKey($route) {
        
        return 'cache_'.md5(serialize($route));
    }
}
