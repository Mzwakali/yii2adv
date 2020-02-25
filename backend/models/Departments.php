<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $department_id
 * @property int $branches_branch_id
 * @property string|null $department_name
 * @property int $companies_company_id
 * @property string|null $department_created_date
 * @property string|null $department_status
 *
 * @property Companies $companiesCompany
 * @property Branches $branchesBranch
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'branches_branch_id', 'companies_company_id'], 'required'],
            [['department_id', 'branches_branch_id', 'companies_company_id'], 'integer'],
            [['department_created_date'], 'safe'],
            [['department_status'], 'string'],
            [['department_name'], 'string', 'max' => 100],
            [['department_id'], 'unique'],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
            [['branches_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branches_branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'branches_branch_id' => 'Branches Branch ID',
            'department_name' => 'Department Name',
            'companies_company_id' => 'Companies Company ID',
            'department_created_date' => 'Department Created Date',
            'department_status' => 'Department Status',
        ];
    }

    /**
     * Gets query for [[CompaniesCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'companies_company_id']);
    }

    /**
     * Gets query for [[BranchesBranch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranchesBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branches_branch_id']);
    }
}