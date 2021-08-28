class RenameComponentColumnToSubs < ActiveRecord::Migration[6.0]
  def change
    rename_column :subs, :component, :genre
  end
end
