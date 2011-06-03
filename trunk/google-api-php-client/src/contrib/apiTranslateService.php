<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * The Translate service implementation
 *
 * Generated by http://code.google.com/p/google-api-php-client/
 * Generated from: http://www.googleapis.com/discovery/0.1/describe?api=translate&apiVersion=v2
 **/
class apiTranslateService {

  // Variables that the apiServiceResource implementation depends on
  private $serviceName = 'translate';
  private $version = 'v2';
  private $baseUrl = 'https://www.googleapis.com/';
  private $io;
  // apiServiceResource's that are used internally
  private $translations;

  /**
   * Constructs the internal service representations and does the auto-magic configuration required to drive them
   */
  public function __construct(apiClient $apiClient) {
    $apiClient->addService('translate', 'v2');
    $this->io = $apiClient->getIo();
    $this->translations = new apiServiceResource($this, $this->serviceName, 'translations', json_decode('{"methods":{"list":{"pathUrl":"language\/translate\/v2","rpcName":"language.translations.list","httpMethod":"GET","methodType":"rest","parameters":{"source":{"parameterType":"query","required":false},"q":{"parameterType":"query","required":false},"target":{"parameterType":"query","required":false},"format":{"parameterType":"query","required":false}}},"listinternal":{"pathUrl":"language\/translate\/v2\/internal","rpcName":"language.translations.listinternal","httpMethod":"POST","methodType":"rest","parameters":{"source":{"parameterType":"query","required":false},"q":{"parameterType":"query","required":false},"target":{"parameterType":"query","required":false},"format":{"parameterType":"query","required":false}}}}}', true));
  }

  /**
   * Implementation of the language.translations.list method.
   * See: http://code.google.com/apis/buzz/v1/using_rest.html#language.translations.list
   *
   * @param $source optional
   * @param $q optional
   * @param $target optional
   * @param $format optional
   */
  public function listTranslations($source = null, $q = null, $target = null, $format = null) {
    return $this->translations->__call('list', array(array('source' => $source, 'q' => $q, 'target' => $target, 'format' => $format)));
  }

  /**
   * Implementation of the language.translations.listinternal method.
   * See: http://code.google.com/apis/buzz/v1/using_rest.html#language.translations.listinternal
   *
   * @param $postBody required
   * @param $source optional
   * @param $q optional
   * @param $target optional
   * @param $format optional
   */
  public function listinternalTranslations($postBody, $source = null, $q = null, $target = null, $format = null) {
    return $this->translations->__call('listinternal', array(array('postBody' => $postBody, 'source' => $source, 'q' => $q, 'target' => $target, 'format' => $format)));
  }

  /**
   * @return the $io
   */
  public function getIo() {
    return $this->io;
  }

  /**
   * @param $io the $io to set
   */
  public function setIo($io) {
    $this->io = $io;
  }

  /**
   * @return the $version
   */
  public function getVersion() {
    return $this->version;
  }

  /**
   * @return the $baseUrl
   */
  public function getBaseUrl() {
    return $this->baseUrl;
  }

  /**
   * @param $version the $version to set
   */
  public function setVersion($version) {
    $this->version = $version;
  }

  /**
   * @param $baseUrl the $baseUrl to set
   */
  public function setBaseUrl($baseUrl) {
    $this->baseUrl = $baseUrl;
  }
    
}

