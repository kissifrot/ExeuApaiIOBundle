<?php
/*
 * Copyright 2013 Jan Eichhorn <exeu65@googlemail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Exeu\ApaiIOBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * ExeuApaiIOExtension.
 *
 * @author Jan Eichhorn <exeu65@googlemail.com>
 */
class ExeuApaiIOExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('apaiio-service.xml');

        $this->loadApaiIOService($config, $container);
    }

    /**
     * Prepares the ApaiIO Service
     *
     * @param array            $config    The extension configurationarray
     * @param ContainerBuilder $container The containerbuilder
     */
    protected function loadApaiIOService($config, ContainerBuilder $container)
    {
        $apaiIOService = $container->getDefinition('apaiio');
        $apaiIOService->replaceArgument(0, $config);
    }
}
