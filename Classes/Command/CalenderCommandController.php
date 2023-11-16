<?php
namespace ISP\Calender\Command;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Eel\FlowQuery\FlowQuery;

class CalenderCommandController extends CommandController
{

    /**
    * @Flow\Inject
    * @var Neos\ContentRepository\Domain\Service\ContextFactoryInterface
    */
    protected $contextFactory;

    /**
    * @Flow\Inject
    * @var \Neos\ContentRepository\Domain\Service\NodeTypeManager
    */
    protected $nodeTypeManager;

    /**
    * @Flow\Inject
    * @var \Neos\Neos\Utility\NodeUriPathSegmentGenerator
    */
    protected $uriPathGenerator;

    /**
     * Create calendar automatically
     *
     * This command generates the base structure for the calendar.
     *
     * Make sure to specify a type which best suits the kind of drink
     * you're aiming for. Some types are better suited for a Latte, while
     * others make a perfect Espresso.
     *
     * @param string $year Year to create
     * @param integer $shots The number of shots
     * @param boolean $ristretto Make this coffee a ristretto
     */
    public function createCommand(int $year): void
    {
        $context =  $this->contextFactory->create();
        $q = new FlowQuery([$context->getCurrentSiteNode()]);
        $parentNode = $q->find('[instanceof ISP.Calender:CalenderRoot]')->get(0);

        if($q->find('[instanceof Neos.Neos:Shortcut]')->filter('[title <= "' . $year . '"]')->get()){

            $this->output->outputLine('<error>The year ' . $year . ' already exists!</error>');

        } else {

            $nodeTemplate = new \Neos\ContentRepository\Domain\Model\NodeTemplate();
    
            $nodeTemplate->setNodeType($this->nodeTypeManager->getNodeType('Neos.Neos:Shortcut'));
            $nodeTemplate->setProperty('title', $year);
            $nodeTemplate->setProperty('targetMode', "firstChildNode");
        
            $newNode = $parentNode->createNodeFromTemplate($nodeTemplate);
        
            $uriPathSegment = $this->uriPathGenerator->generateUriPathSegment($newNode);
            $newNode->setProperty('uriPathSegment', $uriPathSegment);
    
            //$months = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');    

            $this->output->outputLine('<success>The year ' . $year . ' has been created successfully!</success>');

        }
    }
}
