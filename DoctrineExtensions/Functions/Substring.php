<?php

namespace Blast\DoctrinePgsqlBundle\DoctrineExtensions\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * Pattern matching function
 * Usage: SUBSTRING(field, regexp)
 * Outputs: SUBSTRING(field FROM regexp)
 */
class Substring extends FunctionNode
{
    protected $field;
    protected $regexpExpression;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->regexpExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->valueExpression = $parser->StringExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'SUBSTRING(' . $this->field->dispatch($sqlWalker) . ' FROM ' .
            $sqlWalker->walkStringPrimary($this->regexpExpression) . ')';
    }

}
