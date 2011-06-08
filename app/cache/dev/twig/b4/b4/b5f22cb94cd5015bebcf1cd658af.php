<?php

/* AcmeStoreBundle:Default:delete.html.twig */
class __TwigTemplate_b4b4b5f22cb94cd5015bebcf1cd658af extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("AcmeStoreBundle::layout.html.twig");
        }

        return $this->parent;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 20
        $context['code'] = $this->env->getExtension('demo')->getCode($this);
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <h1>Submit ID</h1>

    <form action=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete"), "html");
        echo "\" method=\"post\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, 'form'));
        echo " id=\"login\">
        ";
        // line 7
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, 'form'));
        echo "
        <div>
            ";
        // line 9
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, 'form'), "id", array(), "any", false));
        echo "
            ";
        // line 10
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, 'form'), "id", array(), "any", false));
        echo "
            ";
        // line 11
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, 'form'), "id", array(), "any", false));
        echo "
        </div>
        ";
        // line 13
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, 'form'));
        echo "

        <input type=\"submit\" class=\"symfony-button-grey\" value=\"Submit\" />
    </form>

";
    }

    public function getTemplateName()
    {
        return "AcmeStoreBundle:Default:delete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
