class CreateSubs < ActiveRecord::Migration[6.0]
  def change
    create_table :subs do |t|
      t.string :name, null: false
      t.string :image, null: false
      t.integer :component, null: false, default: 0
      t.integer :calorie, null: false
      t.float :sugar, null: false
      t.float :lipid, null: false
      t.float :salt, null: false

      t.timestamps
    end
  end
end
