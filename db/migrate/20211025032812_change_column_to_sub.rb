class ChangeColumnToSub < ActiveRecord::Migration[6.0]
  def change
    change_column_null :subs, :calorie, false
    change_column_null :subs, :sugar, false
    change_column_null :subs, :lipid, false
    change_column_null :subs, :salt, false
    change_column_null :subs, :name, false
  end
end
