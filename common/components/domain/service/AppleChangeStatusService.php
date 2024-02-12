<?php

namespace common\components\domain\service;

use common\components\domain\exceptions\AppleChangeStatusException;
use common\models\Apple;
use yii\db\Expression;

class AppleChangeStatusService
{
    private Apple $apple;

    public function __construct(Apple $apple)
    {
        $this->apple = $apple;
    }

    /**
     * @return bool
     */
    public function setTree(): bool
    {
        return $this->changeStatus(Apple::STATUS_TREE);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function setDrop(): bool
    {
        if ($this->apple->status != Apple::STATUS_TREE) {
            /** TODO: new Exception */
            throw new AppleChangeStatusException(\Yii::t("app", "Apple not in tree"));
        }

        $this->apple->date_drop = new Expression('NOW()');

        return $this->changeStatus(Apple::STATUS_DROP);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function setRotten(): bool
    {
        if ($this->apple->status == Apple::STATUS_TREE) {
            /** TODO: new Exception */
            throw new AppleChangeStatusException(\Yii::t("app", "Apple on tree"));
        }

        return $this->changeStatus(Apple::STATUS_ROTTEN);
    }

    /**
     * @param string $status
     * @return bool
     * @throws \Exception
     */
    public function setStatus(string $status): bool
    {
        switch ($status) {
            case Apple::STATUS_TREE:
                return $this->setTree();
            case Apple::STATUS_DROP:
                return $this->setDrop();
            case Apple::STATUS_ROTTEN:
                return $this->setRotten();
        }

        return false;
    }

    /**
     * @param string $status
     * @return bool
     */
    protected function changeStatus(string $status): bool
    {
        if ($this->apple->status == $status) {
            return false;
        }

        $this->apple->status = $status;
        $this->apple->save();

        return true;
    }
}